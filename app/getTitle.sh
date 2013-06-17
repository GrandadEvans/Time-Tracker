#!/bin/bash

export DISPLAY=:0
echo $DISPLAY
wmctrl -lp | grep `echo $(xprop -root | grep _NET_ACTIVE_WINDOW | head -1 | awk '{print $5}' | sed 's/,//' | sed 's/^0x/0x0/')`

