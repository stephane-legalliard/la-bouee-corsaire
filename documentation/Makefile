.PHONY: all

all: scope-statement.pdf

scope-statement.pdf: src/*.dia src/scope-statement.tex
	dia -e bpmn-task-creation.eps     src/bpmn-task-creation.dia
	dia -e bpmn-task-disabling.eps    src/bpmn-task-disabling.dia
	dia -e bpmn-task-update.eps       src/bpmn-task-update.dia
	dia -e bpmn-user-connection.eps   src/bpmn-user-connection.dia
	dia -e bpmn-user-creation.eps     src/bpmn-user-creation.dia
	dia -e bpmn-user-deconnection.eps src/bpmn-user-deconnection.dia
	dia -e bpmn-user-disabling.eps    src/bpmn-user-disabling.dia
	dia -e bpmn-user-update.eps       src/bpmn-user-update.dia
	dia -e uml.eps                    src/uml.dia
	xelatex src/scope-statement.tex
	xelatex src/scope-statement.tex
	rm -f *.eps *.aux *.log *.out *.toc

clean:
	rm -f *.eps *.aux *.log *.out *.toc
	rm -f scope-statement.pdf
