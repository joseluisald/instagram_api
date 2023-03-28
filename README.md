<h4>Simples API que pega todas as medias do seu instagram</h4>

#Logue no Facebook Developers e crie um App<br>

Link: https://developers.facebook.com/apps<br>

#No link acima cria o app Consumidor<br>
#Após a criação, no menu lateral esquerdo, vá em Configurações/Basico<br>
    #Desça até "Adicionar plataforma"<br>
    #Selecione WebSite<br>
    #Insira a URL do seu site<br>

#Clique em Adicionar Produto<br>
#Em "Exibição básica do Instagram" selecione "Configurar"<br>
    #Em "Exibição básica" desça até "Create New App"<br>
    #Desça até "User Token Generator" e clique em "Add or Remove Instagram Testers"<br>
    #Em "Testadores do Instagram" clique no "Adicionar Testadores do Instagram" e busque por seu @user<br>

#Após selecionar o seu @user, vá até seu instagram, configurações e autorize seu usuário como testador<br>

#Volte no Facebook Developers, meus Aplicativos.<br>
#Selecione o app recém criado, no menu lateral esquerdo vá em "Exibição básica do Instagram", "Exibição Básica"<br>
#Desça até "User Token Generator" e seu @user irá aparecer caso tenha feito tudo certo.<br>
#Clique em "Generate Token" e salve o token em um arquivo localizado em <br>

<pre>
    raiz_do_site/vendor/joseluisald/instagram_api/src/insta_token.txt
</pre>

#Pronto<br>

Instalação<br>

<pre>
    composer require joseluisald/instagram_api:dev-main
</pre>

Modo de Uso
<pre>
    require __DIR__.'/vendor/autoload.php';

    $insta = new \Instagram_api\Instagram();

    if($insta->getError())
    {
        var_dump($insta->getError());
    }
    else
    {
        var_dump($insta->getMedias());
    }
</pre>