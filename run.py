#!/usr/bin/env python

from __future__ import absolute_import
from __future__ import print_function

import argparse
import sys

import os

import lib.docker as docker
from lib.error import PipelineError
from lib.logger import logger
from lib.utils import DEFAULT_CONFIG_FILE
from lib.utils import read_configuration


def parse_cli():
    parser = argparse.ArgumentParser()
    parser.add_argument('-s', '--stage',
                        required=True,
                        help='which stage do you want to execute?')
    return parser.parse_args()


def main():
    args = parse_cli()
    stage = args.stage
    try:
        project_name = os.environ['CI_PROJECT_NAME']
    except KeyError:
        raise PipelineError('CI_PROJECT_NAME is not defilend')
    project_config = read_configuration(DEFAULT_CONFIG_FILE)
    steps = project_config[stage]['steps']

    for step in steps:
        if 'skip' in steps[step] and steps[step]['skip'] == 'true' :
            logger.info('\nSkipped step: {0} in stage: {1}'.format(step, stage))
            continue;
        logger.info('\nstage: {0}, step: {1}'.format(stage, step))
        image_name = "{0}{1}".format(project_name,
                                     steps[step]['docker-image-suffix'])
        dockerfile = steps[step]['dockerfile']
        options = steps[step]['options']
        command = steps[step]['command']
        volumes = steps[step]['volumes']
        try:
            output = steps[step]['output']
        except KeyError:
            output = None
        docker.execute(image_name=image_name, dockerfile=dockerfile,
                       options=options, command=command, volumes=volumes,
                       output=output)
        docker.cleanup_volumes('/app')


if __name__ == '__main__':
    try:
        main()
    except Exception as error:
        logger.error(error)
        docker.cleanup_volumes('/app')
        sys.exit(-1)
