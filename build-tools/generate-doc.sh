#!/bin/sh
date
make clean
make -e html LANG=en
make -e html LANG=pt-br
date
