.PHONY: all

all: scope-statement.pdf

scope-statement.pdf: src/scope-statement.tex
	xelatex src/scope-statement.tex
	xelatex src/scope-statement.tex
	rm -f scope-statement.aux scope-statement.log scope-statement.out scope-statement.toc

clean:
	rm -f scope-statement.pdf
