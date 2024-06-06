#!/bin/bash

echo -e "${BLUE}--- that file://${REPO_PATH}/${name_repo}/.d/.ham/main/main.fn.lst.d/zzz_git_reset__.sh ---${NORMAL}" #sistem info mesage
echo -e "${HLIGHT}--- git_reset__() ---${NORMAL}"                                                                 #start files

if ! cd ${REPO_PATH}/${name_repo}; then
    plt_exit "in fs= file://${REPO_PATH}/${name_repo}/.d/.ham/main/main.fn.lst.d/zzz_git_reset__.sh , line=${LINENO}, ${FNN}() : : EXEC_FAIL : 'cd ${REPO_PATH}/${name_repo}' : return 1"
    return 1
fi

if ! git_reset__; then
    plt_info "in file://${REPO_PATH}/${name_repo}/.d/.ham/main/main.fn.lst.d/zzz_git_reset__.sh : FAIL_EXEC : file_size_check_arg_mb_proc__ham__d() : return 1"
    return 1
fi

return 0
