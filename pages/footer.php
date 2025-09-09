<footer class="footer py-4 end-line w-100 ">
    <div class="container-fluid">
      <div class="d-flex flex-column flex-md-row justify-content-between">

        <!-- Coluna 1 -->
        <div class="mb-3 mb-md-0">
          <h5>Sobre Nós</h5>
          <div class="row">
            <div class="d-inline-flex align-items-center">
              <p class="mb-1 me-3">Aitom Henrique Donatoni </p>
              <a href="#" class="text-light fs-5 me-3"><i class="fab fa-instagram" data-bs-toggle="tooltip"
                  title="Instagram"></i></i></a>
              <a href="#" class="text-light fs-5 me-3"><i class="fab fa-github" data-bs-toggle="tooltip"
                  title="GitHub"></i></a>
            </div>
          </div>
          <div class="row">
            <div class="d-inline-flex align-items-center">
              <p class="mb-1 me-3">Fernando Consolin Rosa</p>
              <a href="#" class="text-light fs-5 me-3"><i class="fab fa-instagram" data-bs-toggle="tooltip"
                  title="Instagram"></i></i></a>
              <a href="#" class="text-light fs-5 me-3"><i class="fab fa-github" data-bs-toggle="tooltip"
                  title="GitHub"></i></a>
            </div>
          </div>
        </div>

        <!-- Coluna 2 -->
        <div>
          <h5>Contato</h5>
          <ul class="list-unstyled mb-0">
            <li>Email: contato@exemplo.com</li>
            <li>Telefone: (11) 1234-5678</li>
            <li>Endereço: Rua Exemplo, 123</li>
          </ul>
        </div>

      </div>
    </div>
  </footer>

  <!-- Script para tooltip dos icones footer -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
      tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
    });
  </script>