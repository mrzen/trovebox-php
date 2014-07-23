
test:
	vendor/bin/phpunit

docs:
	cd docs && make html && cd -


# For ReadTheDocs
.PHONY: docs


