<?php

namespace Util;

abstract class ConstantesGenericasUtil
{
    /* REQUESTS */
    public const TIPO_REQUEST = ['GET', 'POST', 'DELETE'];
    public const TIPO_GET = ['HOST'];
    public const TIPO_POST = ['USUARIOS', 'HOST', 'EMAIL'];
    public const TIPO_DELETE = ['USUARIOS', 'HOST'];

    /* ERROS */
    public const MSG_ERRO_TIPO_ROTA = 'Rota n�o permitida!';
    public const MSG_ERRO_RECURSO_INEXISTENTE = 'Recurso inexistente!';
    public const MSG_ERRO_GENERICO = 'Algum erro ocorreu na requisi��o!';
    public const MSG_ERRO_SEM_RETORNO = 'Nenhum registro encontrado!';
    public const MSG_ERRO_NAO_AFETADO = 'Nenhum registro afetado!';
    public const MSG_ERRO_TOKEN_VAZIO = '� necess�rio informar um Token!';
    public const MSG_ERRO_TOKEN_NAO_AUTORIZADO = 'Token n�o autorizado!';
    public const MSG_ERR0_JSON_VAZIO = 'O Corpo da requisi��o n�o pode ser vazio!';
    public const MSG_ERRO_HOST_NAO_AUTORIZADO = 'Host n�o autorizado!';
    public const MSG_ERRO_INSERCAO = 'Erro ao inserir registro';
    public const MSG_ERRO_TOKEN_GENERICO = 'Erro ao gerar token!';

    /* SUCESSO */
    public const MSG_DELETADO_SUCESSO = 'Registro deletado com Sucesso!';
    public const MSG_ATUALIZADO_SUCESSO = 'Registro atualizado com Sucesso!';

    /* RECURSO HOSTS */
    public const MSG_ERRO_ID_OBRIGATORIO = 'ID � obrigat�rio!';
    public const MSG_ERRO_LOGIN_EXISTENTE = 'Login j� existente!';
    public const MSG_ERRO_LOGIN_SENHA_OBRIGATORIO = 'Login e Senha s�o obrigat�rios!';

    /* RETORNO JSON */
    const TIPO_SUCESSO = 'sucesso';
    const TIPO_ERRO = 'erro';

    /* OUTRAS */
    public const SIM = 'S';
    public const TIPO = 'tipo';
    public const RESPOSTA = 'resposta';
}