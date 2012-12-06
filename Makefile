BLANQ = ./css/blanq.css
BLANQ_LESS = ./less/blanq.less
BOOSTRAP_JS = ./lib/bootstrap/js/
DATE=$(shell date +%I:%M%p)
HR = --------------------------------------------------

#
# BUILD BLANQ
#

build:
	@echo "\n${HR}"
	@echo "Building Blanq..."
	@echo "${HR}"
	@jshint js/blanq-custom.js --config js/.jshintrc
	@echo "Running JSHint on custom javascript...        Done"
	@lessc --yui-compress ${BLANQ_LESS} > ${BLANQ}
	@echo "Compiling LESS with YUI Compressor...         Done"
	@cat ${BOOSTRAP_JS}bootstrap-transition.js ${BOOSTRAP_JS}bootstrap-alert.js ${BOOSTRAP_JS}bootstrap-button.js ${BOOSTRAP_JS}bootstrap-carousel.js ${BOOSTRAP_JS}bootstrap-collapse.js ${BOOSTRAP_JS}bootstrap-dropdown.js ${BOOSTRAP_JS}bootstrap-modal.js ${BOOSTRAP_JS}bootstrap-tooltip.js ${BOOSTRAP_JS}bootstrap-popover.js ${BOOSTRAP_JS}bootstrap-scrollspy.js ${BOOSTRAP_JS}bootstrap-tab.js ${BOOSTRAP_JS}bootstrap-typeahead.js ${BOOSTRAP_JS}bootstrap-affix.js > js/bootstrap.js
	@cat js/bootstrap.js js/blanq-custom.js > js/blanq.tmp.js
	@uglifyjs -o js/blanq.js js/blanq.tmp.js
	@rm js/bootstrap.js js/blanq.tmp.js
	@echo "Compiling and minifying javascript...         Done"
	@echo "${HR}"
	@echo "BLANQ successfully built at ${DATE}."
	@echo "\n"

watch:
	echo "Watching less files..."; \
	watchr -e 'watch("less/.*\.less$") { system "make" }'