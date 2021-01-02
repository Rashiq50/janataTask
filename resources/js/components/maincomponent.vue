<template>
<div>
    <div style="height: 100vh; overflow:auto; z-index: 20; ">
        <div class="container p-5" style="background-color: white;">
        <h1 class="text-center mb-2" style="font-size: 1.5rem">Data Visualization</h1>
        <div class="p-2">
                      <GChart
            v-if="showChart"
            type="LineChart"
            :data="chartData"
            :options="chartOptions"
            />
        </div>
        <div class="text-center mb-2">
        <button v-on:click="getAll()" class="btn btn-primary">Load Chart</button>
        </div>
        <div class="border border-bottom-0 p-3"  style="width:100%; margin:auto; border-radius:10px">
            <form class="collapse mb-3"  id="collapseExample">
              <!-- @csrf -->
              <div class="row mb-2">
                <div class="col">
                  <input type="date" v-model="dataObject.date" name="date" class="form-control" placeholder="Date">
                </div>
                <div class="col">
                  <input type="text" v-model="dataObject.trade_code" name="trade_code" class="form-control" placeholder="Trade code">
                </div>
                <div class="col">
                  <input type="text" v-model="dataObject.high" name="high" class="form-control" placeholder="High">
                </div>
              </div>
              <div class="row mb-2">
                <div class="col">
                  <input type="text" v-model="dataObject.low" name="low" class="form-control" placeholder="low">
                </div>
                <div class="col">
                  <input type="text" v-model="dataObject.open" name="open" class="form-control" placeholder="Open">
                </div>
                <div class="col">
                  <input type="text" v-model="dataObject.close" name="close" class="form-control" placeholder="Close">
                </div>
                <div class="col">
                  <input type="text" v-model="dataObject.volume" name="volume" class="form-control" placeholder="Volume">
                </div>
                <div class="col">
                  <button type="button" v-on:click="addEntry()" class="btn btn-dark btn-sm mt-1" role="button">Add</button>
                </div>
              </div>
              <div class="row mb-2">
              </div>
          </form>
            <div style="text-align: center">
                <button class="btn btn-sm btn-dark" data-toggle="collapse" data-target="#collapseExample">+</button>
            </div>
          </div>
          <div class="card">
            <table class="table mb-2" style="width:100%;border-radius:10px;">
            <thead class="text-center" style="background-color: rgb(163, 163, 163)">
              <tr>
                <th class="p-3 text-uppercase">id</th>
                <th class="p-3 text-uppercase">Date</th>
                <th class="p-3 text-uppercase">Trade_code</th>
                <th class="p-3 text-uppercase">High</th>
                <th class="p-3 text-uppercase">Low</th>
                <th class="p-3 text-uppercase">Open</th>
                <th class="p-3 text-uppercase">Close</th>
                <th class="p-3 text-uppercase">Volume</th>
                <th class="p-3 text-uppercase">Action</th>
              </tr>
            </thead>
            <tbody class="">
                    <tr v-for="entry in entries" :key="entry.id" class="text-center p-2">
                        <td> {{ entry.id }} </td>
                        <td> {{ new Date(entry.date) | dateFormat('MMM DD, YYYY')  }} </td>
                        <td> {{ entry.trade_code }} </td>
                        <td> {{ entry.high }} </td>
                        <td> {{ entry.low }} </td>
                        <td> {{ entry.open }} </td>
                        <td> {{ entry.close }} </td>
                        <td> {{ entry.volume }} </td>
                        <td>
                          <div style="display: flex; justify-content: space-between">
                              <button class="btn btn-sm btn-primary"> <a class="text-decoration-none text-light" v-bind:href="'/edit/'+ entry.id"><i class="fa fa-edit"></i></a></button> 
                              <button v-on:click="remove(entry.id)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button> 
                          </div>
                        </td>
                    </tr>
            </tbody>
          </table>
          </div>
          <div style="width:70%; overflow:hidden; margin:auto;" class="mt-2">
            <pagination :limit="15" :data="main" @pagination-change-page="getData"></pagination>
          </div>    

        </div>
    </div>
</div>

</template>

<script>
import { GChart } from 'vue-google-charts'
    export default {
        data(){
            return{
                showChart:false,
                
                dataObject:{
                    trade_code:"",
                    date:"",
                    high:"",
                    low:"",
                    open:"",
                    close:"",
                    volume:"",
                },

                main:{},
                entries:[],
                chartData: [
                    ['Date', 'Volume'],
                ],
                chartOptions: {
                    chart: {
                    title: 'Company Performance',
                    subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                    }
                }
            }
        },

        created(){
            this.getData();
        },

        methods:{
            getAll(){
                axios.get('http://janatawifi.herokuapp.com/api/data/all').then(
                    res => {
                        const a = res.data;
                        const dummy = []
                        for (let i = 0; i < a.length;) {
                            const element = a[i];
                            const b = [  new Date(element.date).toLocaleString(), element.volume ]
                            this.chartData.push(b);
                            i = i + 1000;
                        }

                        this.showChart=true;
                    }
                )
            },
            getData(page){
                console.log(page);
            if (typeof page === 'undefined') {
                    page = 1;
            }
            axios.get('http://janatawifi.herokuapp.com/api/data?page='+page)
            .then(response => {
                this.entries=response.data.data;
                this.main=response.data;
                console.log(this.main); 
            });
            },
            addEntry(){
                console.log(this.dataObject);
                axios.post('http://janatawifi.herokuapp.com/api/add', this.dataObject)
                .then(
                    res =>{ console.log("done!");
                    this.dataObject = { 
                        trade_code:"",
                        date:"",
                        high:"",
                        low:"",
                        open:"",
                        close:"",
                        volume:"",
                    };}
                )
            },

            remove(id){
              console.log(id);
              axios.post('http://janatawifi.herokuapp.com/delete/'+id).then(res => {
                this.entries = this.entries.filter( a => a.id != id );
              })
            }
        },
    }
</script>
