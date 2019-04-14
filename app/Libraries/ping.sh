#!/usr/bin/env bash

arg1="${1:-}"

# set script constants
PING_WHICH=/bin/ping
PING_SERVER="8.8.8.8"
PING_LOCAL="192.168.0.1"
PHP_WHICH=/usr/bin/php
TEMP_PATH=/opt/xampp/htdocs/ns/app/Libraries/ping_data/
TEMP_PING_NAME=ping.txt
# set nsetspead constants
NS_PATH=/opt/xampp/htdocs/ns/
NS_COMMAND="store:ping"

${PING_WHICH} ${PING_SERVER} -fqc 10 > ${TEMP_PATH}${TEMP_PING_NAME}
${PHP_WHICH} ${NS_PATH}artisan ${NS_COMMAND} ${TEMP_PATH}${TEMP_PING_NAME}
rm ${TEMP_PATH}${TEMP_PING_NAME}

${PING_WHICH} ${PING_LOCAL} -fqc 10 > ${TEMP_PATH}${TEMP_PING_NAME}
${PHP_WHICH} ${NS_PATH}artisan ${NS_COMMAND} ${TEMP_PATH}${TEMP_PING_NAME}
rm ${TEMP_PATH}${TEMP_PING_NAME}
