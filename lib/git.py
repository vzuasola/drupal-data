#!/usr/bin/env python

"""
This module abstracts the use of git without using git python module
"""

from __future__ import print_function
from __future__ import absolute_import
import os
import subprocess
from .logger import logger
from .progressbar import ProgressBar
from .error import PipelineError
from .utils import gitlab_var, project_dir
from .utils import read_json_configuration
from .docker import run_command


def git_executable():
    """
    Returns the full path to the git executable.
    """
    for path in os.environ['PATH'].split(':'):
        git_path = os.path.join(path, 'git')
        if os.path.exists(git_path):
            return git_path


def git_log(options=None):
    """
    Retrieves the git commit log
    """
    cmd = [git_executable()]

    cmd.append('log')
    if options is not None:
        for option in options:
            cmd.append(option)
    
    result = run_git_command(cmd, None)

    return result


def run_git_command(cmd, output_file):
    """
    Execute and return the output
    """
    logger.debug(" ".join(cmd));
    process = subprocess.Popen(cmd, stdout=subprocess.PIPE)
    buff = ""
    result = ""
    progressbar = ProgressBar()
    
    if output_file:
        logger.info('redirecting output to: {0} (it may take a while)'.format(output_file))
        output_file = open(output_file, 'w')
    
    while True:
        out = process.stdout.read(1)
        if out == '' and process.poll() != None:
            break
        if out != '':
            buff = "{0}{1}".format(buff, out)
            result = "{0}{1}".format(result, out)
            if buff.endswith('\n'):
                msg = buff.strip()
                if output_file:
                    output_file.write(msg)
                else:
                    logger.debug(msg)
                buff = ""

    if output_file:
        output_file.close()
        progressbar.complete()
        logger.info('done!')

    # clean up
    if process.poll() != 0 :
        raise PipelineError('{0} failed'.format(' '.join(cmd)))
    return result


def get_sonar_sha():
    """
    Retrieves the commit sha that is needed by SonarQube for the Gitlab plugin. This also sets it as an environment variable $SONAR_COMMIT_SHA
    """

    if 'CI_COMMIT_SHA' not in os.environ:
        msg = "{0} is not defined in your environment".format('CI_COMMIT_SHA')
        raise PipelineError(msg)

    # @todo: Find a solution for this since this will not achieve the correct goal of SonarQube baseline check.
    if 'BASELINE_BRANCH' not in os.environ:
        baseline_branch = os.environ['CI_COMMIT_REF_NAME']
    else:
        baseline_branch = os.environ['BASELINE_BRANCH']

    addtl_options = [
        "--pretty=format:%H",
        "origin/" + baseline_branch + ".." + os.environ['CI_COMMIT_SHA']
    ]
    logger.debug(addtl_options);

    commit_sha = git_log(addtl_options)
    final_commit_sha = commit_sha.replace('\n', ',')
    
    logger.debug('Commit SHA for SonarQube: {0}'.format(final_commit_sha))
    os.environ['SONAR_COMMIT_SHA'] = final_commit_sha
