#!/usr/bin/env bash

#####################
# speedtest-cli is required
# cd /path/to/system/dir && sh app/Libraries/speedtest.sh
#####################

# set script constants
SPEEDTEST_WHICH=/usr/bin/speedtest-cli
PHP_WHICH=/usr/bin/php
TEMP_PATH=app/Libraries/speedtest_data/
TEMP_SPEEDTEST_NAME=speedtest.txt

# set nsetspead constants
NS_COMMAND="store:speedtest"

${SPEEDTEST_WHICH} ${HOST} --simple > ${TEMP_PATH}${TEMP_SPEEDTEST_NAME}
${PHP_WHICH} artisan ${NS_COMMAND} ${TEMP_PATH}${TEMP_SPEEDTEST_NAME}
rm ${TEMP_PATH}${TEMP_SPEEDTEST_NAME}
