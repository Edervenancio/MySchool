$(function () {
    $("button#btnEntrar").on("click", function (e) {
        e.preventDefault();

        var classe = $("div#formulario").attr("class");

        if (classe == "esqueci") {
            var campoEmail = $("form#formularioLogin #email").val();
            if (campoEmail.trim() == "") {
                $("div#mensagem").show().removeClass("red").html("Preencha o seu Email.");
            } else {
                $.ajax({
                    url: "./controller/login_controller.php",
                    type: "POST",
                    data: {
                        type: "esqueci",
                        email: campoEmail
                    },

                    success: function (retorno) {
                        retorno = JSON.parse(retorno);

                        if (retorno["erro"] == 1) {
                            $("div#mensagem").show().addClass("red").html(retorno["mensagem"]);
                        } else if (retorno["erro"] == 2) {
                            $("div#mensagem").show().removeClass("red").html(retorno["mensagem"]);
                        }
                    },

                    error: function () {
                        $("div#mensagem").show().addClass("red").html("Ocorreu um erro durante a solicitação");
                    }
                });
            }
        } else {
            var campoEmail = $("form#formularioLogin #email").val();
            var campoSenha = $("form#formularioLogin #passwordUser").val();



            if (campoEmail.trim() == "" || campoSenha.trim() == "") {
                $("div#mensagem").show().removeClass("red").html("Preencha todos os campos.");
            } else {
                $.ajax({
                    type: "POST",
                    url: "./controller/login_controller.php",
                    data: {
                        type: "login",
                        email: campoEmail,
                        passwordUser: campoSenha
                    },

                    success: function (retorno) {
                        retorno = JSON.parse(retorno);

                        if (retorno["erro"] == 1) {
                            $("div#mensagem").show().addClass("red").html(retorno["mensagem"]);
                        } else if (retorno["erro"] == 2) {
                            $("div#mensagem").show().removeClass("red").html(retorno["mensagem"]);
                        } else {
                            window.location = "./view/dashboard.php";
                        }
                    },

                    error: function () {
                        $("div#mensagem").show().addClass("red").html("Ocorreu um erro durante a solicitação");
                    }
                });
            }
        }
    });


    $("button#btnCadastrar").on("click", function (e) {
        e.preventDefault();

        var campoEmail = $("form#formularioCadastro  #emailCadastro").val();
        var campoSenha = $("form#formularioCadastro  #senhaCadastro").val();
        var campoNome = $("form#formularioCadastro  #nomeCadastro").val();
        var campoNascimento = $("form#formularioCadastro  #nascimentoCadastro").val();
        var campoTelefone = $("form#formularioCadastro  #telefoneCadastro").val();
        var campoRa = $("form#formularioCadastro  #raCadastro").val();

        if (campoEmail.trim() == "" || campoSenha.trim() == "" ||
            campoNome.trim() == "" || campoNascimento.trim() == "" ||
            campoTelefone.trim() == "" || campoRa.trim() == "") {

            $("div#mensagem").show().removeClass("red").html("Preencha todos os campos.");
        } else {
            $.ajax({
                url: "./controller/login_controller.php",
                type: "POST",
                data: {
                    type: "cadastro",
                    email: campoEmail,
                    passwordUser: campoSenha,
                    nome: campoNome,
                    birth: campoNascimento,
                    phone: campoTelefone,
                    id: campoRa
                },

                success: function (retorno) {
                    retorno = JSON.parse(retorno);

                    if (retorno["erro"] == 1) {
                        $("div#mensagem").show().addClass("red").html(retorno["mensagem"]);
                    } else if (retorno["erro"] == 2) {
                        $("div#mensagem").show().removeClass("red").html("Enviamos um email de confirmação para " + campoEmail + "");
                    } else {
                        window.location = "../../view/dashboard.php";
                    }
                },

                error: function () {
                    $("div#mensagem").show().addClass("red").html("Ocorreu um erro durante a solicitação");
                }
            });
        }
    });

    $("a#esqueciSenha").on("click", function () {
        $("div#formulario").addClass("esqueci");

        $("form#formularioLogin span.title").html("Digite o seu email");
        $("button#btnEntrar").html("Enviar");
        $("div#formulario div#linha.passwordUser").hide();
        $(this).hide();
    });



    $("button.change").on("click", function () {

        $("div#formulario").toggleClass("Cadastro");

        $("form#formularioCadastro").toggle();
        $("form#formularioLogin").toggle();

        $("div#textoLogin").toggle();
        $("div#textoCadastro").toggle();
    })
});