#!/bin/bash

echo -e "${BLUE}--- that file://${REPO_PATH}/${name_repo}/.d/.ham/main/main.fn.lst.d/file_size_check.sh ---${NORMAL}" #sistem info mesage
echo -e "${HLIGHT}--- file_size_check_arg_mb_proc__ham__d() 45 ---${NORMAL}" #start files

if ! file_size_check_arg_mb_proc__ham__d "45" ; then
    plt_info "in file://${REPO_PATH}/${name_repo}/.d/.ham/main/main.fn.lst.d/file_size_check.sh : FAIL_EXEC : file_size_check_arg_mb_proc__ham__d() : return 1"
    return 1
fi

return 0
