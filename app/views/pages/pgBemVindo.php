

<div class="bodyPage">
    <div class="groupBody">
        <h3><strong>Bem-vindo ao Lince</strong></h3>

        <?php
            if(in_array($_SESSION["classeAgente"], [4])){
               echo "<div style='text-align: justify;'>
                    <h2><strong>Recursos Humanos</strong></h2>
                    <p>Na parte principal você pode ter um geral da tela, onde pode buscar funcionário ou data.</p>
                    <p>Para buscar um funcionário digite o que pretende depois escolha que tipo de dados está buscando e clique no botão verde da lupa para buscar.</p>
                    <p>Você também pode fazer uma busca combinada com funcionário e data</p>
                    <p>Em lista essa exibição é a lista de formação já registrada no sistema.</p>
                    <p>Está distribuido por código do funcionário, nome, tipo de formação, data, tempo que durou a formação, local e ação, onde você pode excluir o registro.</p>
                    <p>No botão 'Listar Formação', será o nome das formações, ao clicar no botão será aberta uma janela e você pode gerenciar os titulos das formações, criar excluir ou editar.</p>
                    <p>Para criar uma nova formação digite o nome da nova formação e cliente no botão verde com sibolo de +, para adicionar nova formação.</p>
                    <p>para editar clique no lapis amarelo do nome que deseja alterar, e será carregada no campo de input para realizar a edição, depois clique no botão amarelo e para salvar a edição</p>
                    <p>Para excluir você deve clicar na lixeira e confirmar a exclusão.</p>
                    <p>O mesmo serve para 'Listar Local'</p>
                    <br>
                    <p>No botão 'Listar funcionário' você pode listar todos os funcionário cadastrado no sistema. </p>
                    <p>Ao abrir a janela, você pode buscar um funcionário digitando o código do funcionario e depois clicando no botão verde da lupa, caso o funcionário exista será carregado no campo input</p>
                    <p>Para criar um novo funcionário preencha os campos de cod do funcionário, nome do funcionário e clique no botão verde 'salvar'</p>
                    <p>Ao clicar no lapis você pode editar um registro do funcionario, será carregado os inptus com os dados, depois para salvar clique em salvar.</p>
                </div>
               "; 
            }

            if(in_array($_SESSION["classeAgente"], [1,2])){
                echo "<div style='text-align: justify;'>
                        <h2><strong>Ordem de compra</strong></h2>
                        <p>No sistema principal, você pode criar ordem de compra, visualizar. Essa ordem de compra será para o responsável realizar a validação. Quanto mais informações tiver na ordem de compra melhor para entender a necessidade da compra.</p>
                        <p>Ao criar a ordem de compra e marcando a caixa “Enviar email ao fornecedor”, caso essa opção esteja marcada na criação, assim que aprovado o sistema enviar um email ao fornecedor solicitando a conclusão do orçamento, então você pode usar os campos “Nº do orçamento” e o campo do lado para anexar o orçamento que já tenha em mãos. Esses campos não são obrigatórios, mas ajudam o fornecedor a concluir com mais agilidade. O sistema pegará esse anexo que colocou e irá enviar junto por email.</p>
                        <p>Mas agora, caso não queira que o fornecedor não receba o email assim que aprovado, é só não marcar essa caixa, mas assim que a ordem for aprovada você poderá enviar o email usando o sistema, no ícone de enviar que irá aparecer assim que a ordem de compra for aprovada.</p>
                        <p>O campo do segundo anexo, será usado internamente, esse sim é obrigatório, pode adicionar quantos anexos forem necessários e qualquer tipo de arquivo.</p>
                        <p>O sistema consegue abrir qualquer tipo de foto ou PDF, os arquivos que o sistema não consiga abrir, será informado para realizar o download do mesmo e poder visualizar em um programa de sua preferência.</p>
                        <p>Ao cadastrar um fornecedor você deve colocar um email do fornecedor obrigatoriamente para as ações acima funcionarem corretamente.</p>
                        <p>Para você administrador além das funções acima você pode aprovar as ordens de compras e criar novos utilizadores e também poderá alterá-lo.</p>
                    </div>";
            }
            
        ?>
        <div style='text-align: justify;'>
            <p>Qualquer erro que venha acontecer se possível tirar um print é enviar para o email <strong><a href='mailton:henrique.garcia@grupofeira.pt'>henrique.garcia@grupofeira.pt</a></strong>.</p>
            <p>O sistema estará em atualizações constantes, mas tentaremos realizar essas atualizações fora do horário de trabalho habitual.</p>
        </div>
        
    </div>
</div>

