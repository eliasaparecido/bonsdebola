<template>
  <div>
    <div class="row">
       <div class="col-sm-6 com-md-6">
      <b-table
      ref="selectableTable"
      selectable
      select-mode="multi"
      :items="items"
      :fields="fields"
      @row-selected="onRowSelected"
      responsive="sm"
    >
      <template v-slot:cell(selected)="{ rowSelected }">
        <template v-if="rowSelected">
          <span aria-hidden="true">&check;</span>
          <span class="sr-only">Selected</span>
        </template>
        <template v-else>
          <span aria-hidden="true">&nbsp;</span>
          <span class="sr-only">Not selected</span>
        </template>
      </template>
    </b-table>
    </div>
    <div class="col-sm-6 com-md-6">
      <p>
      <b-button size="sm" @click="selectAllRows">Selecionar Todos</b-button>
      <b-button size="sm" @click="clearSelected">Limpar Seleção</b-button>
        <label>Qtde Jogador</label>
        <select v-model="qtdejogador">
            <option disabled value="">Selecione a quantidade de jogadores</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
        </select>
      <b-button size="sm" @click="montarTime">Formar Time</b-button>
      <b-button v-if="selected.length === 1" size="sm" @click="edit">Editar</b-button>
      <b-button v-if="selected.length === 1" size="sm" @click="deletar">Excluir</b-button>
      </p>
      <p>
        Qtde jogadores selecionado:<br>
        {{ selected.length }}
      </p>
        <div v-if="times.length > 0">
        <ul>
          <li v-for="(time, index) in times" :key="time.id" >
            <div style="background: grey">Time: {{index + 1}}</div>
            <ol>
                <li v-for="t in time" :key="t.id">{{t.nome}} - {{t.nivel}}</li>
            </ol>
          </li>
        </ul>
      </div>
    </div>
    </div>
  </div>
</template>

<script>
  export default {
    props:['jogadores'],
    data(){
        return{
            fields: [
                { key: 'id', label: '#'},
                { key: 'nome', label: 'Nome'},
                { key: 'nivel', label: 'Nível'},
                { key: 'goleiro', label: 'É Goleiro?'},
            ],
            items: [],
            selected: [],
            qtdejogador: 0,
            times:[],
            count:0,
        }
    },
    created(){
        this.items = this.jogadores;
    },
    methods:
    {
        onRowSelected(items) {
            this.selected = items
            //console.log(this.selected)
        },
        selectAllRows() {
            this.$refs.selectableTable.selectAllRows()
        },
        clearSelected() {
            this.$refs.selectableTable.clearSelected();
            this.times = [];
        },
        edit()
        {
          var getUrl = window.location.host;
           
          window.location.href = `http://${getUrl}/jogadores/${this.selected[0].id}/edit`;
        },
        deletar()
        {
            var getUrl = window.location.host;
           
           window.location.href = `http://${getUrl}/jogadores/${this.selected[0].id}/delete`;
        },
        montarTime() {
          axios.post(`jogadores/montar-time/${this.qtdejogador}/`, this.selected).then((resp)=>{
            this.times = resp.data;
            console.log(resp)
          }).catch((e) => {
            alert(e.response.data)
            console.log(e)
          })
        }
    },
        
};
</script>