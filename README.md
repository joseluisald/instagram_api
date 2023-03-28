Simples API que pega todas as medias do seu instagram

#Logue no Facebook Developers e crie um App

Link: https://developers.facebook.com/apps

#No link acima cria o app Consumidor
#Após a criação, no menu lateral esquerdo, vá em Configurações/Basico
    #Desça até "Adicionar plataforma"
    #Selecione WebSite
    #Insira a URL do seu site

#Clique em Adicionar Produto
#Em "Exibição básica do Instagram" selecione "Configurar"
    #Em "Exibição básica" desça até "Create New App"
    #Desça até "User Token Generator" e clique em "Add or Remove Instagram Testers"
    #Em "Testadores do Instagram" clique no "Adicionar Testadores do Instagram" e busque por seu @user

#Após selecionar o seu @user, vá até seu instagram, configurações e autorize seu usuário como testador

#Volte no Facebook Developers, meus Aplicativos.
#Selecione o app recém criado, no menu lateral esquerdo vá em "Exibição básica do Instagram", "Exibição Básica"
#Desça até "User Token Generator" e seu @user irá aparecer caso tenha feito tudo certo.
#Clique em "Generate Token" e salve o token em um arquivo "raiz_do_site/vendor/instagram_api/src/insta_token.txt"

#Pronto

Instalação

<pre>
    composer require joseluisald/instagram_api
</pre>

Modo de Uso
<pre>
    require __DIR__.'/Instagram.php';

    $insta = new Instagram();

    if($insta->getError())
    {
        var_dump($insta->getError());
    }
    else
    {
        var_dump($insta->getMedias());
    }
</pre>
