#!/bin/sh
#
# ZFDoc-PhD
#
# LICENSE
#
# This source file is subject to the new BSD license that is bundled
# with this package in the file LICENSE.txt.
# If you did not receive a copy of the license and are unable to
# obtain it through the world-wide-web, please send an email
# to mauriciofauth@gmail.com so we can send you a copy immediately.
#
# @category     Documentation
# @author       Maurício Meneghini Fauth <mauriciofauth@gmail.com>
# @copyright    Copyright (c) 2011 Maurício Meneghini Fauth <mauriciofauth@gmail.com>
# @license      http://www.opensource.org/licenses/bsd-license    New BSD License
date
make clean
make -e VERSION=1.11 LANG=en
make -e VERSION=1.11 LANG=de
make -e VERSION=1.11 LANG=es
make -e VERSION=1.11 LANG=fr
make -e VERSION=1.11 LANG=ja
make -e VERSION=1.11 LANG=pt-br
make -e VERSION=1.11 LANG=ru
make -e VERSION=1.10 LANG=en
make -e VERSION=1.10 LANG=de
make -e VERSION=1.10 LANG=es
make -e VERSION=1.10 LANG=fr
make -e VERSION=1.10 LANG=ja
make -e VERSION=1.10 LANG=pt-br
make -e VERSION=1.10 LANG=ru
date
