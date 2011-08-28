#
# Makefile - build Zend Framework documentation with PhD
#
# Main targets:
#  all - render DocBook manual in HTML.
#  clean - remove staged files.
#

LANG=en
MANUAL_XML=manual.xml

all:	html

html:
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
	@rm -Rf ./output/manual/css/.svn
	@rm -Rf ./output/manual/js/.svn

clean:
	@rm -Rf ./temp
	@rm -Rf ./output
