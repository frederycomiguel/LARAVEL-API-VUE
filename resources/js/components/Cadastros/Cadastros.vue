<template>
  <div>
    <h1>Cadastros API</h1>

    <!-- Add Cadastro -->
    <form @submit.prevent="createCadastro" class="cadastro-form">
      <div class="form-group">
        <input type="text" v-model="cadastro.title" class="form-input" placeholder="Title">
      </div>
      <div class="form-group">
        <textarea v-model="cadastro.body" class="form-input" placeholder="Body"></textarea>
      </div>

      <button type="submit" class="button-submit">Salvar</button>
    </form>

    <div class="center">
      <div class="pagination">
          <a href="#" v-bind:class="[{ disabled: !pagination.next_page_url }]" @click=fetchCadastros(pagination.next_page_url)>Anterior</a>

        <a href="#" class="current-page">Página {{ pagination.current_page }} of {{ pagination.last_page }}</a>
          <a href="#" v-bind:class="[{ disabled: !pagination.prev_page_url }]" @click=fetchCadastros(pagination.prev_page_url)>Próximo</a>

      </div>
    </div>
    <div class="card-container">
      <div class="card-cadastro" v-for="cadastro in cadastros" :key="cadastro.id">
        <div class="card-cadastro-header">
          <h2>{{ cadastro.title }}</h2>
          <p>{{ cadastro.body }}</p>
        </div>
        <div class="card-cadastro-footer">
          <button class="button-edit" @click="editCadastro(cadastro)">
            <img src="../../../assets/edit.svg" alt="" srcset="">
          </button>
          <button class="button-delete" @click="deleteCadastro(cadastro.id)">
            <img src="../../../assets/trash.svg" alt="" srcset="">
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Cadastros',
  data() {
    return {
      cadastros: [],
      cadastro: {
        id: '',
        title: '',
        body: ''
      },
      cadastro_id: '',
      pagination: {},
      edit: false
    }
  },
  created() {
    this.fetchCadastros()
  },
  methods: {
    fetchCadastros(page_url) {
      let vm = this

      page_url = page_url || 'api/cadastros'

      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.cadastros = res.data
          vm.makePagination(res.meta, res.links)
        })
        .catch(err => console.log(err))
    },
    makePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      }

      this.pagination = pagination
    },
    deleteCadastro(id) {
      if (confirm('Are you sure?')) {
        fetch(`api/cadastro/${id}`, { method: 'delete' })
          .then(res => res.json())
          .then(data => {
            alert('Cadastro Deletado!')
            this.fetchCadastros()
          })
          .catch(err => console.log(err))
      }
    },
    createCadastro() {
      if (this.edit === false) {
        fetch('api/cadastro', {
          method: 'post',
          body: JSON.stringify(this.cadastro),
          headers: {
            'Content-Type': 'application/json'
          }
        })
        .then(res => res.json())
        .then(data => {
          this.clearForm()
          alert('Cadastro Criado!')
          this.fetchCadastros()
        })
        .catch(err => console.log(err))
      } else {
        fetch('api/cadastro', {
          method: 'put',
          body: JSON.stringify(this.cadastro),
          headers: {
            'Content-Type': 'application/json'
          }
        })
        .then(res => res.json())
        .then(data => {
          this.clearForm()
          alert('Cadastro Atualizado!')
          this.fetchCadastros()
        })
        .catch(err => console.log(err))
      }
    },
    editCadastro(cadastro) {
      this.edit = true
      this.cadastro.id = cadastro.id
      this.cadastro.cadastro_id = cadastro.id
      this.cadastro.title = cadastro.title
      this.cadastro.body = cadastro.body
    },
    clearForm() {
      this.edit = false
      this.cadastro_id = null
      this.cadastro.id = null
      this.cadastro.title = ''
      this.cadastro.body = ''
    }
  }
}
</script>

<style scoped>
  a {
    color: #4a4a4a;
    text-decoration: none;
    cursor: default;
  }

  h1 {
    color: #4a4a4a;
  }

  .cadastro-form {
    display: block;
    margin: 10px 0;
  }

  .cadastro-form .form-group {
    margin: 15px 0;
  }

  .cadastro-form .form-group .form-input {
    width: 100%;
    padding: 10px 15px;
    border: 1px solid #e2e2e2;
    color: #4a4a4a;
    border-radius: 6px;
    outline: none;
    transition: .2s;
  }

  .cadastro-form .form-group .form-input:focus {
    border: 1px solid rgb(0, 174, 239);
  }

  .cadastro-form .button-submit {
    border: 1px solid transparent;
    width: 150px;
    padding: 10px 20px;
    border-radius: 6px;
    cursor: pointer;
    outline: none;
    background-color: rgb(0, 174, 239);
    color: #fff;
    transition: .3s;
  }

  .cadastro-form .button-submit:hover {
    background-color: rgb(5, 150, 202);
  }

  /* Cadastro Card Style */
  .card-container {
    margin: 5px 0;
    display: flex;
    flex-direction: column;
  }

  .card-container .card-cadastro {
    margin: 10px 0;
    border: 1px solid #e2e2e2;
    border-radius: 6px;
    text-align: center;
  }

  .card-container .card-cadastro .card-cadastro-header {
    padding: 20px;
  }

  .card-container .card-cadastro .card-cadastro-header h2 {
    color: #4a4a4a;
    margin-bottom: 20px;
  }

  .card-container .card-cadastro .card-cadastro-header p {
    color: #8d8b8b;
  }

  .card-container .card-cadastro .card-cadastro-footer {
    border-top: 1px solid #e2e2e2;
    padding: 20px;
    display: flex;
    justify-content: space-evenly;
  }

  .card-container .card-cadastro .card-cadastro-footer button {
    border: 1px solid transparent;
    width: 150px;
    padding: 10px 20px;
    border-radius: 30px;
    cursor: pointer;
    outline: none;
    background-color: rgb(218, 214, 214);
  }

  .card-container .card-cadastro .card-cadastro-footer button.button-edit {
    background-color: rgb(0, 174, 239);
    color: #fff;
    transition: .3s;
  }

  .card-container .card-cadastro .card-cadastro-footer button.button-delete {
    transition: .3s;
  }

  .card-container .card-cadastro .card-cadastro-footer button.button-edit:hover {
    background-color: rgb(5, 150, 202);
  }

  .card-container .card-cadastro .card-cadastro-footer button.button-delete:hover {
    background-color: rgb(190, 190, 190);
  }

  /* Pagination Style */
  .pagination {
    margin-top: 5px;
    display: inline-block;
  }

  .pagination a {
    float: left;
    padding: 8px 16px;
    margin-right: 10px;
    border: 1px solid rgb(216, 216, 216);
    border-radius: 6px;
    cursor: pointer;
    transition: .2s;
  }

  .pagination a.disabled {
    pointer-events: none;
    cursor: default;
  }

  .pagination a.current-page {
    pointer-events: none;
    cursor: default;
  }

  .pagination a.active {
    background-color: rgb(0, 174, 239);
    border-color: transparent;
    color: white;
  }

  .pagination a:hover:not(.active) {
    background-color: rgb(0, 174, 239);
    border-color: transparent;
    color: white;
  }
</style>
