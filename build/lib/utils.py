"""
This module provides basic utilities
"""

from __future__ import print_function
from __future__ import absolute_import
import hashlib
import json
import os
import tarfile
import shutil
from .error import PipelineError

# some constants...
CURRENT_DIR = os.path.abspath(os.path.dirname(__file__))
# colors
INFO = '\033[94m[INFO]  \033[0m'
SUCCESS = '\033[92m[OK]    \033[0m'
FAILED = '\033[91m[FAILED]\033[0m'

# default configuration file
BUILD_DIR = os.path.join(CURRENT_DIR, os.pardir)
DEFAULT_CONFIG_FILE = os.path.join(BUILD_DIR, 'deploy.json')


def artifactory_urls():
    """
    Reads the configuration from deploy.json and return the artifactory
    instances urls
    for more information about the package names, please refer to the
    README.md file in this project.
    """
    config = read_coniguration(DEFAULT_CONFIG_FILE, 'artifactory')
    for artifactory in config['instances']:
        yield "{0}/{1}".format(artifactory, _archive_name())


def _version():
    return "{0}.{1}".format(gitlab_var('VERSION', default='999'),
                            gitlab_var('CI_PIPELINE_ID', default='999'))


def _package_name():
    package = gitlab_var('CI_PROJECT_NAME', default='just_a_test')
    return "{0}-{1}".format(package, _version())


def _archive_name():
    return os.path.join('{0}.tar.gz'.format(_package_name()))


def _archive_path():
    return os.path.join(project_dir(), _archive_name())


def _archive_exclude(filename):
    config = read_coniguration(DEFAULT_CONFIG_FILE, 'project')
    archive_exclude_directories = config['archive_exclude_directories']
    archive_exclude_extensions = tuple(config['archive_exclude_extensions'])
    if filename.name.endswith('robots.txt'):
        return filename
    if os.path.split(filename.name)[1] in archive_exclude_directories:
        return None
    if filename.name.endswith(archive_exclude_extensions):
        return None
    return filename


def read_coniguration(config_file, environment):
    """
    reads the deployment configuration for a given environment

    Args:
        environment (str): environment about to be deployed

    Returns:
        (dict): deployment configuration for a given environment

    Raises:
        PipelineError
    """
    try:
        with open(config_file, 'r') as json_in:
            deploy_config = json.load(json_in)
        return deploy_config[environment]
    except IOError as error:
        msg = 'cannot read configuration file: {0}'.format(error)
        raise PipelineError(msg)
    except KeyError:
        msg = ('{0} provided environment name, {1}, does in the specified '
               'configuation file: {2}' .format(FAILED,
                                                environment, config_file))
        raise PipelineError(msg)


def read_json_configuration(json_file):
    """
    Reads a json file and returns a dictionary of its content

    Args:
        json_file (str): path to the json file

    Returns:
        dict: content of json file

    Raises:
        PipelineError
    """
    try:
        with open(json_file, 'r') as json_in:
            return json.load(json_in)
    except IOError as error:
        msg = 'cannot read configuration file: {0}'.format(error)
        raise PipelineError(msg)


def project_dir():
    """
    Returns the location of the project main directory, it is set by gitlab but
    in case we are running this locally we need to define it in other ways
    (hint is two directories up from this file)
    """
    if 'CI_PROJECT_DIR' in os.environ:
        return os.environ['CI_PROJECT_DIR']
    else:
        # trying to make it readable...
        build_dir = os.path.abspath(os.path.join(CURRENT_DIR, os.pardir))
        return os.path.abspath(os.path.join(build_dir, os.pardir))


def deployment_conf_dir():
    """
    Returns the deployment configuration directory: deploy/
    """
    return os.path.join(project_dir(), 'deploy')


def gitlab_var(var_name, default):
    """

    Args:
        var_name (str): name of the variable

    Returns:
        (str): value of the variable
    """
    if var_name in os.environ:
        return os.environ[var_name]
    return default


def md5(filename, blocksize=65536):
    """
    calculate md5 hash on filename

    Args:
            filename (str):

    Returns:
            (str) md5 hash of the file
    """
    hash_ = hashlib.md5()
    with open(filename, 'rb') as f:
        for block in iter(lambda: f.read(blocksize), b''):
            hash_.update(block)
    return hash_.hexdigest()


def sha1(filename, blocksize=65536):
    """
    calculate sha1 hash on filename

    Args:
            filename (str):

    Returns:
            (str) sha1 hash of the file
    """
    hash_ = hashlib.sha1()
    with open(filename, 'rb') as f:
        for block in iter(lambda: f.read(blocksize), b''):
            hash_.update(block)
    return hash_.hexdigest()


def create_archive(archive_name=None, base_dir=None, filter_fn=_archive_exclude):
    """
    create a tar.gz archive from base_dir excluding items
    provided in exclude

    Args:
        archive_name (str): name of the archive to create

        base_dir (str): name of the directory to compress

        exclude (list, tuple): elements to exclude from the archive

    Raises:
        PipelineError
    """
    # execute the pre archive steps
    _pre_archive()

    if not archive_name:
        archive_name = _archive_path()
    if not base_dir:
        # read the base directory as configured in our deploy.json file
        base_dir = read_coniguration(DEFAULT_CONFIG_FILE, 'project')['archive_directory']

    if os.path.exists(archive_name):
        os.remove(archive_name)

    tar = tarfile.open(archive_name, "w:gz")
    tar.add(base_dir, arcname='.', filter=filter_fn)
    tar.close()
    return archive_name


def mkdir_p(directory):
    """
    mkdir -p implementation in python
    """
    if os.path.isdir(directory):
        return
    if os.path.isfile(directory):
        raise PipelineError('cannot mkdir -p {0} (is a file)'.format(directory))
    if os.path.islink(directory):
        raise PipelineError('cannot mkdir -p {0} (is a link)'.format(directory))
    full_path = ''
    for path in directory.split(os.sep):
        full_path = os.path.join(full_path, path)
        try:
            print(full_path)
            os.mkdir(full_path)
        except OSError:
            # directory already exists, just pass for now
            # we will raise a PipelineError if "directory"
            # does not exist
            pass
    if not os.path.isdir(directory):
        raise PipelineError("mkdir_p, cannot create {0}".format(directory))


def _drupal7_pre_archive():
    """
    copies site directory into -> base/sites/all/default
    """
    print('pre-archive steps')
    site_dest = os.path.join('base', 'sites', 'default')
    vendor_dest = os.path.join('base', 'sites', 'all', 'vendor')
    for directory in (site_dest, vendor_dest):
        if os.path.exists(directory):
            try:
                shutil.rmtree(directory)
                # at this point, there's no base/sites/all/default
                intermediate_dirs = os.path.join(*(directory.split(os.sep)[0:-1]))
                mkdir_p(intermediate_dirs)
            except OSError as error:
                try:
                    os.remove(directory)
                except OSError as error:
                    raise PipelineError(error)
            except shutil.Error as error:
                raise PipelineError(error)
    shutil.copytree('site', site_dest)
    shutil.copytree('vendor', vendor_dest)


def _drupal8_pre_archive():
    """
    copies site directory into -> base/sites/all/default
    """
    print('pre-archive steps')
    site_dest = os.path.basename('base')
    if os.path.exists(site_dest):
        try:
            shutil.rmtree(site_dest)
            # at this point, there's no base/sites/all/default
            intermediate_dirs = os.path.join(*(site_dest.split(os.sep)[0:-1]))
            mkdir_p(intermediate_dirs)
        except OSError as error:
            try:
                os.remove(site_dest)
            except OSError as error:
                raise PipelineError(error)
        except shutil.Error as error:
            raise PipelineError(error)
    for item in ('config', 'drush', 'vendor', 'web'):
        shutil.copytree(item, os.path.join(site_dest, item))


def _pre_archive():
    """
    Don't call this function directly, create_archive will do it for you
    In drupal7, "composer" do not create files into the right directory
    we need do copy some files.
    Drupal8 instead creates files into the right place, so this function
    will have on drupal8 projects
    """
    config = read_coniguration(DEFAULT_CONFIG_FILE, 'project')
    project_style = config['style']
    if project_style == 'drupal7':
        _drupal7_pre_archive()
    elif project_style == 'drupal8':
        _drupal8_pre_archive()
