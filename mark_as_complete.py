#!/usr/bin/env python
"""
marks a step as complete
"""

import os
import sys
import json
import datetime
from lib.logger import logger


def main():
    if 'CREATES' not in os.environ:
        msg = "{0} is not defined in your environment".format('CREATES')
        raise PipelineError(msg)
    for create in os.environ['CREATES'].split(','):
        data = {'date': str(datetime.date.today())}
        with open(create, 'a') as data_out:
            data_out.write(json.dumps(data))
    
    logger.info('stage complete')


if __name__ == '__main__':
    try:
        main()
    except Exception as error:
        logger.error('failed to mark this stage as complete')
        sys.exit(1)
