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

#
# Makefile - build Zend Framework documentation with PhD
#
# Main targets:
#  all - render DocBook manual in HTML.
#  clean - remove staged files.
#

LANG=en de es fr it ja pt-br ru
MANUAL_XML=manual.xml
DOC_PATH=../trunk/documentation/manual

all:	website

html:	$(MANUAL_XML)
	@rm -Rf ./output
	@mkdir ./output
	@for lang in $(LANG) ; \
	do \
	    echo "Executing sed on file ./temp/$$lang/$(MANUAL_XML)." ; \
	    sed -ir -e 's/<index id="the.index" \/>//' "./temp/$$lang/$(MANUAL_XML)" ; \
	    echo "Upgrading ./temp/$$lang/$(MANUAL_XML) to DocBook v5." ; \
	    xsltproc --xinclude ./db4-upgrade.xsl ./temp/$$lang/$(MANUAL_XML) > ./temp/$$lang/manual-db5.xml ; \
	    echo "Rendering $$lang manual." ; \
	    php ./phd/render.php -x -g 'phpdotnet\phd\Highlighter_GeSHi' -f zfpackage -o ./output/$$lang -d ./temp/$$lang/manual-db5.xml ; \
	done
	@rm -Rf ./temp

$(MANUAL_XML): $(DOC_PATH)/en
	@rm -Rf ./temp
	@mkdir ./temp
	@echo "Copying lang files..."
	@for lang in $(LANG) ; \
	do \
	    [ -d ./temp/$$lang ] || mkdir ./temp/$$lang ; \
	    cp -Rf $(DOC_PATH)/en/figures ./temp/$$lang ; \
	    cp -Rf $(DOC_PATH)/en/module_specs ./temp/$$lang ; \
	    cp -Rf $(DOC_PATH)/en/ref ./temp/$$lang ; \
	    cp -Rf $(DOC_PATH)/en/tutorials ./temp/$$lang/ ; \
	    cp -Rf $(DOC_PATH)/$$lang ./temp/ ; \
	    ( cd ./temp/$$lang && autoconf && ./configure && make -e $(MANUAL_XML) ) ; \
	    echo "LANG=$$lang done." ; \
	done

website: html
	@[ -d ./website ] || mkdir ./website
	@mv -f ./output ./website/manual
	@for lang in $(LANG) ; \
	do \
	    rm -f ./website/manual/$$lang/index.sqlite ; \
	    cp -Rf ./website/manual/$$lang/zf-package-chunked-xhtml/* ./website/manual/$$lang ; \
	    rm -Rf ./website/manual/$$lang/zf-package-chunked-xhtml ; \
	done
	@cp -f ./index.html.in ./website
	@mv -f ./website/index.html.in ./website/index.html
	@cp -Rf ./styles ./website/manual

clean:
	@rm -Rf ./temp
	@rm -Rf ./output
	@rm -Rf ./website
