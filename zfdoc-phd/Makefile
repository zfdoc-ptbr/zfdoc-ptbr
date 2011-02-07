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

#
# Makefile - build Zend Framework documentation with PhD
#
# Main targets:
#  all - render DocBook manual in HTML.
#  clean - remove staged files.
#

LANG=en
VERSION=1.11
MANUAL_XML=manual.xml

all:	website

$(MANUAL_XML): ../standard/branches/release-$(VERSION)/documentation/manual/en/$(MANUAL_XML).in
	@rm -Rf ./temp
	@mkdir ./temp
	@echo "Copying lang files..."
	@mkdir ./temp/$(LANG)
	@[ -d ./temp/en ] || cp -Rf ../standard/branches/release-$(VERSION)/documentation/manual/en/figures ./temp/$(LANG)
	@[ -d ./temp/en ] || cp -Rf ../standard/branches/release-$(VERSION)/documentation/manual/en/module_specs ./temp/$(LANG)
	@[ -d ./temp/en ] || cp -Rf ../standard/branches/release-$(VERSION)/documentation/manual/en/ref ./temp/$(LANG)
	@[ -d ./temp/en ] || cp -Rf ../standard/branches/release-$(VERSION)/documentation/manual/en/tutorials ./temp/$(LANG)
	@[ -d ./temp/en ] || cp -Rf ../standard/branches/release-$(VERSION)/documentation/manual/$(LANG) ./temp
	@cp -Rf ../standard/branches/release-$(VERSION)/documentation/manual/en ./temp
	@( cd ./temp/$(LANG) && autoconf && ./configure && make -e $(MANUAL_XML) )
	@echo "Executing sed on file ./temp/$(LANG)/$(MANUAL_XML)."
	@sed -ir -e 's/<index id="the.index" \/>//' "./temp/$(LANG)/$(MANUAL_XML)"
	@echo "Upgrading ./temp/$(LANG)/$(MANUAL_XML) to DocBook v5."
	@xsltproc --xinclude ./db4-upgrade.xsl ./temp/$(LANG)/$(MANUAL_XML) > ./temp/$(LANG)/manual-db5.xml
	@echo "Done."

html:	$(MANUAL_XML)
	@[ -d ./output ] || mkdir ./output
	@echo "Rendering $(LANG) manual."
	@php ./phd/render.php -x -f zfdoc -o ./output/html/$(VERSION)/$(LANG) -d ./temp/$(LANG)/manual-db5.xml
	@rm -Rf ./temp

website: html
	@[ -d ./output/website ] || mkdir ./output/website
	@cp -Rf ./output/html/$(VERSION) ./output/website
	@rm -Rf ./output/html
	@rm -f ./output/website/$(VERSION)/$(LANG)/index.sqlite
	@cp -Rf ./output/website/$(VERSION)/$(LANG)/zf-doc-chunked-xhtml/* ./output/website/$(VERSION)/$(LANG)
	@rm -Rf ./output/website/$(VERSION)/$(LANG)/zf-doc-chunked-xhtml
	@cp -f ./index.html.in ./output/website/$(VERSION)
	@mv -f ./output/website/$(VERSION)/index.html.in ./output/website/$(VERSION)/index.html
	@[ -d ./output/website/$(VERSION)/css ] || cp -Rf ./css ./output/website/$(VERSION)
	@[ -d ./output/website/$(VERSION)/js ] || cp -Rf ./js ./output/website/$(VERSION)

trunk:
	@rm -Rf ./temp
	@mkdir ./temp
	@echo "Copying lang files..."
	@mkdir ./temp/$(LANG)
	@[ -d ./temp/en ] || cp -Rf ../documentation/manual/en/figures ./temp/$(LANG)
	@[ -d ./temp/en ] || cp -Rf ../documentation/manual/en/module_specs ./temp/$(LANG)
	@[ -d ./temp/en ] || cp -Rf ../documentation/manual/en/ref ./temp/$(LANG)
	@[ -d ./temp/en ] || cp -Rf ../documentation/manual/en/tutorials ./temp/$(LANG)
	@[ -d ./temp/en ] || cp -Rf ../documentation/manual/$(LANG) ./temp
	@cp -Rf ../documentation/manual/en ./temp
	@( cd ./temp/$(LANG) && autoconf && ./configure && make -e $(MANUAL_XML) )
	@echo "Executing sed on file ./temp/$(LANG)/$(MANUAL_XML)."
	@sed -ir -e 's/<index id="the.index" \/>//' "./temp/$(LANG)/$(MANUAL_XML)"
	@echo "Upgrading ./temp/$(LANG)/$(MANUAL_XML) to DocBook v5."
	@xsltproc --xinclude ./db4-upgrade.xsl ./temp/$(LANG)/$(MANUAL_XML) > ./temp/$(LANG)/manual-db5.xml
	@echo "Done."
	@[ -d ./output ] || mkdir ./output
	@echo "Rendering $(LANG) manual."
	@php ./phd/render.php -x -f zfdoc -o ./output/manual/$(LANG) -d ./temp/$(LANG)/manual-db5.xml
	@rm -Rf ./temp
	@rm -f ./output/manual/$(LANG)/index.sqlite
	@cp -Rf ./output/manual/$(LANG)/zf-doc-chunked-xhtml/* ./output/manual/$(LANG)
	@rm -Rf ./output/manual/$(LANG)/zf-doc-chunked-xhtml
	@[ -d ./output/manual/index.html ] || cp -f ./index.html.in ./output/manual
	@[ -d ./output/manual/index.html ] || mv -f ./output/manual/index.html.in ./output/manual/index.html
	@[ -d ./output/manual/css ] || cp -Rf ./css ./output/manual
	@[ -d ./output/manual/js ] || cp -Rf ./js ./output/manual

clean:
	@rm -Rf ./temp
	@rm -Rf ./output
