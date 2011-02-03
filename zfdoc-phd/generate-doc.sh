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
# @category	Documentation
# @author	Maurício Meneghini Fauth <mauriciofauth@gmail.com>
# @copyright	Copyright (c) 2011 Maurício Meneghini Fauth <mauriciofauth@gmail.com>
# @license	http://www.opensource.org/licenses/bsd-license    New BSD License
date
make clean
make -e LANG="en de es fr it ja pt-br ru"
date
