#!/bin/bash
curl -X GET "http://localhost:8888/get_request.php?category=$1&position=$2" | pbcopy
exit