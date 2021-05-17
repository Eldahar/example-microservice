terminal:
	docker run -it -v ${PWD}:/srv employee /bin/bash

build:
	docker build -t employee .
