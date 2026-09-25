<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convite Professor</title>

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

            .btn {
                width: 100% !important;
                display: block !important;
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
                             src="{{ url('images/logo.svg') }}"
                             alt="Logo"
                             style="width:200px; max-width:100%; height:auto;">
                    </td>
                </tr>
                <tr>
                    <td class="content"
                        style="padding:45px; text-align:center;">

                        <h2 style="margin-bottom:10px; font-size:18px; color:#111;">
                            Você foi convidado para o sistema
                        </h2>

                        <p style="font-size:14px; color:#666; line-height:1.7;">
                            Para ativar sua conta e definir sua senha de acesso,
                            clique no botão abaixo.<br>
                            Este link é pessoal e expira em breve.
                        </p>

                        <div style="margin-top:30px;">
                            <a href="{{ $link }}"
                               class="btn"
                               style="background:#01426A;
                                      color:#fff;
                                      padding:14px 30px;
                                      text-decoration:none;
                                      border-radius:10px;
                                      font-size:14px;
                                      font-weight:bold;
                                      display:inline-block;
                                      box-shadow:0 6px 20px rgba(1,66,106,0.3);">
                                Ativar minha conta
                            </a>
                        </div>

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