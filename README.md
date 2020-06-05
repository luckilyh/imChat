# TP51+workerman+redis

- 需要开启的php函数
  - pcntl_fork
  - pcntl_wait
  - pcntl_signal
  - pcntl_alarm
  - pcntl_signal_dispatch

- 需要安装的扩展
- redis
    - 设定redis user:id初始值 
        ```linux
        set user:id 10000
        ```
- 需要开启文件权限 777