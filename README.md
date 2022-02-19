# How To Use

## start
1. 確認 8089 port是否有被佔用, 若有的話請在docker-compose 內修改nginx的外暴port號
2. 請執行
    ```shell
    docker-compose up -d --build 
    ```
3. 執行完成後即可在 `127.0.0.1:8089`上使用

## Document
文件位置: http://127.0.0.1:8089/api/documentation

> 須執行完畢docker-compose後才可進入
