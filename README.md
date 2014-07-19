SGAE - Sistema de Gestão de Atividades Extracurriculares
========================================================

Trabalho acadêmico realizado no Curso de Sistemas para Internet da Faculdade de Tecnologia de Jahu no ano de 2013.

Versão
------

1.0

Tecnologia
----------

* [Sublime Text] - sofisticado editor de texto para programação.
* [FuelPHP] - framework PHP simples de usar porém muito poderoso
* [Twitter Bootstrap] - ótimo framework HTML5 e CSS3
* [jQuery] - biblioteca JavaScript essencial para projetos modernos
* [Mysql Workbench] - ferramenta para auxilio na modelagem do Banco de Dados

Equipe
------

* Karen Galdino
* Laira Adrieli Luciano
* Luan Oliveira Rodrigues


Instalação
----------

Acesse a pasta "docs" para importar as tabelas do banco de dados. Confira o MER (Modelo de Entidade Relacional), utilizando a ferramenta MySql Workbench.

Atenção: Você deve configurar usuario senha do seu banco de dados no arquivo .htaccess
```sh
# Configuração do Banco de Dados
SetEnv DB_HOST "HOST"
SetEnv DB_USER "USUARIO"
SetEnv DB_PASS "SENHA"
SetEnv DB_NAME "NOME_DO_BANCO"
```

```sh
# Cadastro de Alunos
http://localhost/sgae/cadastrar/
```

```sh
# Acesso ao sistema de Administração
http://localhost/sgae/admin/

Usuario: sgaeadmin
Senha: Fatec2013
```

Licença
-------

MIT


**Software Livre, Huhuu!**

[Sublime Text]:http://www.sublimetext.com/
[FuelPHP]:http://fuelphp.com/
[Twitter Bootstrap]:http://twitter.github.com/bootstrap/
[jQuery]:http://jquery.com
[Mysql Workbench]:http://www.mysql.com/products/workbench/
