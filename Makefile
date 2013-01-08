THEME_NAME = blanq
THEME = blanq
CSS = ./css/${THEME}.css
LESS = ./css/${THEME}.less
BOOSTRAP = ./lib/bootstrap/
DATE=$(shell date +%I:%M%p)
OK_STRING=[OK]
HR=--------------------------------------------------

#
## BUILD THEME
#

build:
	@echo ""
	@echo "Building ${THEME_NAME}..."
	@echo "${HR}"
	@jshint ./js/${THEME}.js --config ./js/.jshintrc
	@echo "Running JSHint on javascript...               ${OK_STRING}"
	@lessc --yui-compress ${LESS} > ${CSS}
	@echo "Compiling LESS with YUI Compressor...         ${OK_STRING}"
	@cat ${BOOSTRAP}js/bootstrap-transition.js ${BOOSTRAP}js/bootstrap-alert.js ${BOOSTRAP}js/bootstrap-button.js ${BOOSTRAP}js/bootstrap-carousel.js ${BOOSTRAP}js/bootstrap-collapse.js ${BOOSTRAP}js/bootstrap-dropdown.js ${BOOSTRAP}js/bootstrap-modal.js ${BOOSTRAP}js/bootstrap-tooltip.js ${BOOSTRAP}js/bootstrap-popover.js ${BOOSTRAP}js/bootstrap-scrollspy.js ${BOOSTRAP}js/bootstrap-tab.js ${BOOSTRAP}js/bootstrap-typeahead.js ${BOOSTRAP}js/bootstrap-affix.js > js/bootstrap.js
	@cat js/bootstrap.js js/${THEME}.js > js/${THEME}.tmp.js
	@uglifyjs -o js/${THEME}.min.js js/${THEME}.tmp.js
	@rm js/bootstrap.js js/${THEME}.tmp.js
	@echo "Compiling and minifying javascript...         ${OK_STRING}"
	@echo "${HR}"
	@echo "${THEME_NAME} successfully built at ${DATE}."
	@echo ""