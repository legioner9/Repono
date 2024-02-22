#!/bin/bash

echo -e "${BLUE}--- that file://${REPO_PATH}/${name_repo}/.d/.ham/main/main.fn.lst.d/broken_symlink.sh ---${NORMAL}" #sistem info mesage
echo -e "${HLIGHT}--- find ${REPO_PATH}/${name_repo} -xtype l ---${NORMAL}"  
                                            
find ${REPO_PATH}/${name_repo} -xtype l

if [[ -n $(find ${REPO_PATH}/${name_repo} -xtype l) ]]; then
    plt_info "in file://${REPO_PATH}/${name_repo}/.d/.ham/main/main.fn.lst.d/broken_symlink.sh : FAIL_EXEC : ${REPO_PATH}/${name_repo} -xtype l : return 1"
    return 1
fi

return 0
