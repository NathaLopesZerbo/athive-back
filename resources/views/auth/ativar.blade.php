<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ativar Conta</title>
    <style>
        @media only screen and (max-width: 640px) {
            .card {
                width: 90% !important;
            }

            .content {
                padding: 25px !important;
            }

            .logo {
                width: 140px !important;
            }
        }
    </style>
</head>

<body style="margin:0; padding:0; background-color:#eef2f7; font-family:Arial, sans-serif;">

<table width="100%" style="padding:50px 0;">
    <tr>
        <td align="center">
            <table class="card"
                   width="600"
                   cellpadding="0"
                   cellspacing="0"
                   style="background:#ffffff;
                          border-radius:14px;
                          overflow:hidden;
                          box-shadow:0 12px 40px rgba(0,0,0,0.10);
                          max-width:600px;
                          width:100%;">
                <tr>
                    <td style="background:#01426A; padding:35px; text-align:center;">
                        <img class="logo"
                             src="{{ asset('images/logo.svg') }}"
                             alt="Logo"
                             style="width:200px; max-width:100%; height:auto;">
                    </td>
                </tr>
                <tr>
                    <td class="content"
                        style="padding:45px; text-align:center;">

                        <h2 style="margin-bottom:10px; font-size:18px; color:#111;">
                            Ativar sua conta
                        </h2>

                        <p style="font-size:14px; color:#666; line-height:1.7;">
                            Para ativar sua conta e definir sua senha de acesso,
                            preencha o campo abaixo.
                        </p>

                        <form method="POST" action="/ativar" style="margin-top:30px;">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <input type="password"
                                   name="senha"
                                   placeholder="Digite sua senha"
                                   required
                                   style="width:100%;
                                          padding:14px;
                                          margin-bottom:20px;
                                          border:1px solid #ddd;
                                          border-radius:10px;
                                          font-size:14px;
                                          box-sizing:border-box;">

                            <button type="submit"
                                    style="width:100%;
                                           background:#01426A;
                                           color:#fff;
                                           padding:14px;
                                           border:none;
                                           border-radius:10px;
                                           font-size:14px;
                                           font-weight:bold;
                                           cursor:pointer;
                                           box-shadow:0 6px 20px rgba(1,66,106,0.3);">
                                Ativar conta
                            </button>
                        </form>

                    </td>
                </tr>
                <tr>
                    <td style="background:#f8fafc; padding:20px; text-align:center; font-size:12px; color:#999;">
                        © {{ date('Y') }} Sistema. Todos os direitos reservados.
                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>