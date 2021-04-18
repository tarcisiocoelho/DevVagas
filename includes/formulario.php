<main>
    <section>
        <a href="index.php">
            <button class="btn btn-success">Voltar</button>
        </a>
    </section>

    <h2 class="mt-3">Cadastrar vaga</h2>
    <form method="post">
        <div class="form-group mb-2">
            <label>Título</label>
            <input class="form-control" type="text" name="titulo">
        </div>

        <div class="form-group mb-2">
            <label>Descrição</label>
            <textarea class="form-control" name="descricao" rows="5"></textarea>
        </div>

        <div class="form-group mb-2">
            <label>Status</label>
            <div>
                <div class="form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="ativo" value="s" checked> Ativo
                    </label>
                </div>

                <div class="form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="ativo" value="n"> Inativo
                    </label>
                </div>
            </div>    
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>
    </form>
</main>