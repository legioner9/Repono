#!/bin/bash

echo -e "${HLIGHT}--- find /home/st/REPOBARE/_repo/tgu -type f -size +40M -not -path /home/st/REPOBARE/_repo/tgu/.git/* ---${NORMAL}" #start files

find /home/st/REPOBARE/_repo/tgu -type f -size +40M -not -path "/home/st/REPOBARE/_repo/tgu/.git/*"

if [ -z "$(find /home/st/REPOBARE/_repo/tgu -type f -size +40M -not -path "/home/st/REPOBARE/_repo/tgu/.git/*")" ]; then
    echo z
fi

if find /home/st/REPOBARE/_repo/tgu -type f -size +40M -not -path "/home/st/REPOBARE/_repo/tgu/.git/*" ; then
    echo "2z"
fi

if [ -n "$(find /home/st/REPOBARE/_repo/tgu -type f -size +40M -not -path "/home/st/REPOBARE/_repo/tgu/.git/*")" ]; then
    echo n
fi

if find /home/st/REPOBARE/_repo/tgu -type f -size +40M -not -path "/home/st/REPOBARE/_repo/tgu/.git/*"; then
    echo "2n"
fi

echo -e "${HLIGHT}--- find /home/st/REPOBARE/_repo/tgu -type f -size +1M -not -path /home/st/REPOBARE/_repo/tgu/.git/* ---${NORMAL}" #start files

find /home/st/REPOBARE/_repo/tgu -type f -size +1M -not -path "/home/st/REPOBARE/_repo/tgu/.git/*"

if [ -z "$(find /home/st/REPOBARE/_repo/tgu -type f -size +1M -not -path "/home/st/REPOBARE/_repo/tgu/.git/*")" ]; then
    echo z
fi

if find /home/st/REPOBARE/_repo/tgu -type f -size +1M -not -path "/home/st/REPOBARE/_repo/tgu/.git/*"; then
    echo "2z"
fi

if [ -n "$(find /home/st/REPOBARE/_repo/tgu -type f -size +1M -not -path "/home/st/REPOBARE/_repo/tgu/.git/*")" ]; then
    echo n
fi

if find /home/st/REPOBARE/_repo/tgu -type f -size +1M -not -path "/home/st/REPOBARE/_repo/tgu/.git/*"; then
    echo "2n"
fi