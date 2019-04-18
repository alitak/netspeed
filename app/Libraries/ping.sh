#!/usr/bin/env bash

#####################
# cd /path/to/system/dir && sh app/Libraries/ping.sh IP_ADDRESS_1 IP_ADDRESS_2 IP_ADDRESS_N
#####################

# set script constants
PING_WHICH=/bin/ping
PHP_WHICH=/usr/bin/php
TEMP_PATH=app/Libraries/ping_data/
TEMP_PING_NAME=ping.txt

# set nsetspead constants
NS_COMMAND="store:ping"

for HOST in "$@"
do
    ${PING_WHICH} ${HOST} -fqc 10 > ${TEMP_PATH}${TEMP_PING_NAME}
    ${PHP_WHICH} artisan ${NS_COMMAND} ${TEMP_PATH}${TEMP_PING_NAME}
    rm ${TEMP_PATH}${TEMP_PING_NAME}
done
