#!/bin/bash

#. "$HOME/.bashrc"

filename="${COMMUNIS_PATH}/Store/codium/download_ext/open_list_anc.sh"

echo -e "${HLIGHT}---start file://$filename with args: $@ ---${NORMAL}" # start file

idir=$(pwd)
dirr=$(prs_f -d $filename)

cd "$dirr" || qq_exit "$(prs_f -d $filename) not found"

garg_ $(prs_f -n $filename) $@ 1>/dev/null

count=0
for str in $(f2e $dirr/list.anc); do
    ((count++))
    echo -e "${GREEN}\$str = $str${NORMAL}" #print variable
    
    yandex-browser-stable "$str"

    if [ $count -eq 5 ]; then
        qq_pause "cotinue?" "$filename" "$LINENO"
        count=0
    fi
done

cd "$idir"

unset filename
