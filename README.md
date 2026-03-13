ERP & Human Resources Management System 🚀

Este projeto é um sistema de gestão empresarial (ERP) focado em Recursos Humanos e Gestão de Compras, desenvolvido para centralizar operações críticas de uma organização, desde a formação de colaboradores até ao fluxo de aprovação de suprimentos.

O sistema destaca-se pela implementação de RBAC (Role-Based Access Control), onde a interface e as funcionalidades adaptam-se dinamicamente ao nível de acesso do utilizador.

🛠️ Funcionalidades Principais

1. Gestão de Compras & Procurement

    Fluxo de Aprovação: Funcionários podem registar necessidades de compra.

    Validação Hierárquica: Os responsáveis têm um painel exclusivo para conferir, aprovar ou rejeitar pedidos.

    Automação de Contacto: Após a aprovação, o sistema dispara automaticamente um e-mail para o fornecedor com os detalhes da ordem de compra.

2. Gestão de Formação e RH

    Controlo de Competências: CRUD completo de funcionários, locais de formação e tipos de cursos.

    Métricas: Visualização dos últimos cadastros com soma automática de horas de formação na listagem principal.

3. Gestão de Escalas e Conflitos (WIP)

    Inteligência de Escala: Lógica para organização de horários com deteção de conflitos (ex: impede que dois responsáveis estejam de folga em simultâneo).

4. Portal do Fornecedor & Formulários Dinâmicos

    Interface Adaptativa: Formulários que alteram os campos de entrada dinamicamente com base no tipo de produto selecionado.

🏗️ Arquitetura do Projeto (MVC)

O sistema foi desenvolvido seguindo o padrão Model-View-Controller (MVC) para garantir uma separação clara entre a lógica de negócio, os dados e a interface:

⚙️ Configuração e Instalação

Para colocar o sistema em funcionamento, é necessário configurar a ligação à base de dados:

    Navegue até ao diretório: app/core/

    Abra o ficheiro: DBConnection.php

    Edite as credenciais de ligação conforme o seu ambiente:
    
    $this->servidor = "localhost";

    $this->banco = "nome_da_base_de_dados";

    $this->usuario = "seu_utilizador";

    $this->senha = "sua_senha";


🔑 Níveis de Acesso

    Nível 1 (ADM): Gestão do sistema e Painel de aprovação de ordem de compras.

    Nível 2 (colaborador): Requisições e acompanhamento.

    Nível 3 (Fornecedor): Submissão de propostas via formulários dinâmicos.
    
    Nível 4 (RH): Gestão de funcionários e métricas de formação e gestão de escalas.

    Nível 5 (Encomendas): Reponsável pela gestão de stock e controle de demandas relacionadas a produtos


🚀 Tecnologias

    Backend: PHP (MVC)

    Base de Dados: MySQL

    Frontend: HTML5, CSS3, JavaScript

*Nota: Este projeto foi desenvolvido como uma solução interna personalizada. Embora o desenvolvimento tenha sido interrompido por decisões estratégicas da organização, o código reflete a implementação de regras de negócio complexas e fluxos de trabalho automatizados.*