<template>
  <el-row>
    <el-col :span="24">
      <el-card>
        <div slot="header" class="tw-flex tw-justify-end">
          <div class="tw-grid tw-grid-cols-2 tw-gap-1">
            <router-link v-slot="{ href, navigate }" :to="{name: 'DataExcelImport'}" custom>
              <a :href="href" class="pan-btn green-btn" @click="navigate">
                <i class="el-icon-plus mr-2" />
                Import
              </a>
            </router-link>
            <router-link v-slot="{ href, navigate }" v-permission="['create']" :to="{name: 'DataExcelCreate'}" custom>
              <a :href="href" class="pan-btn blue-btn" @click="navigate">
                <i class="el-icon-plus mr-2" />
                {{ $t('button.create') }}
              </a>
            </router-link>
          </div>
        </div>
        <el-row :gutter="20" type="flex" justify="space-between" class="tw-mb-6 tw-flex-wrap">
          <el-col :xs="24" :sm="10" :md="6">
            <label>{{ $t('table.texts.filter') }}</label>
            <el-input
              v-model="table.listQuery.search"
              class="tw-w-full"
              :placeholder="$t('table.texts.filterPlaceholder')"
            />
          </el-col>
          <el-col :xs="24" :sm="14" :md="10">
            <br />
            <el-date-picker
              v-model="table.listQuery.updated_at"
              class="tw-w-full"
              type="daterange"
              :start-placeholder="$t('date.start_date')"
              :end-placeholder="$t('date.end_date')"
              :picker-options="pickerOptions"
              @change="changeDateRangePicker"
            />
          </el-col>
        </el-row>
        <el-row :gutter="20">
          <el-col :span="24" class="table-responsive">
            <el-table
              v-loading="table.loading"
              class="tw-w-full"
              :data="table.list"
              :default-sort="{ prop: table.listQuery.orderBy, order: table.listQuery.ascending }"
              border
              fit
              highlight-current-row
              @sort-change="sortChange"
            >
              <el-table-column align="center" sortable="custom" prop="id" :label="$t('table.data_excel.id')" width="70px">
                <template slot-scope="{ row }">
                  {{ row.id }}
                </template>
              </el-table-column>
              <el-table-column data-generator="name" prop="name" :label="$t('table.data_excel.name')" align="left" header-align="center">
                <template slot-scope="{ row }">
                  {{ row.name }}
                </template>
              </el-table-column>
              <el-table-column data-generator="content" prop="content" :label="$t('table.data_excel.content')" align="left" header-align="center">
                <template slot-scope="{ row }">
                  {{ row.content }}
                </template>
              </el-table-column>
              <!--{{$TEMPLATES_NOT_DELETE_THIS_LINE$}}-->
              <el-table-column data-generator="updated_at" prop="updated_at" :label="$t('date.updated_at')" sortable="custom" align="center" header-align="center">
                <template slot-scope="{ row }">
                  {{ row.updated_at | parseTime('{y}-{m}-{d} {h}:{i}') }}
                </template>
              </el-table-column>
              <el-table-column :label="$t('table.actions')" align="center" class-name="small-padding fixed-width">
                <template slot-scope="{ row }">
                  <router-link v-permission="['edit']" :title="$t('button.edit')" :to="{name: 'DataExcelEdit', params: {id: row.id}}"><i class="el-icon-edit el-link el-link--primary tw-mr-2" /></router-link>
                  <a v-permission="['delete']" :title="$t('button.delete')" class="cursor-pointer" @click.stop="() => remove(row.id)"><i class="el-icon-delete el-link el-link--danger" /></a>
                </template>
              </el-table-column>
            </el-table>
            <pagination v-if="table.total > 0" :total="table.total" :page.sync="table.listQuery.page" :limit.sync="table.listQuery.limit" @pagination="getList" />
          </el-col>
        </el-row>
      </el-card>
    </el-col>
  </el-row>
</template>
<script>
  import DateRangePicker from '@/plugins/mixins/date-range-picker';
  import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
  import { debounce } from '@/utils';
  import DataExcelsResource from '@/api/v1/data-excel';
  const dataExcelResource = new DataExcelsResource();

  export default {
    components: { Pagination },
    mixins: [DateRangePicker],
    data() {
      return {
        table: {
          listQuery: {
            search: '',
            limit: 25,
            ascending: 'descending',
            page: 1,
            orderBy: 'updated_at',
            updated_at: [],
          },
          list: null,
          total: 0,
          loading: false,
        },
      };
    },
    watch: {
      'table.listQuery.search': debounce(function () {
        this.handleFilter();
      }, 500),
    },
    created() {
      this.getList();
    },
    methods: {
      async getList() {
        try {
          this.table.loading = true;
          const { data } = await dataExcelResource.list(this.table.listQuery);
          this.table.list = data.data;
          this.table.total = data.count;
          this.table.loading = false;
        } catch (e) {
          this.table.loading = false;
        }
      },
      handleFilter() {
        this.table.listQuery.page = 1;
        this.getList();
      },
      changeDateRangePicker(date) {
        if (date) {
          const startDate = this.parseTimeToTz(date[0]);
          const endDate = this.parseTimeToTz(date[1]);
          this.table.listQuery.updated_at = [startDate, endDate];
        } else {
          this.table.listQuery.updated_at = [];
        }
        this.handleFilter();
      },
      sortChange(data) {
        const { prop, order } = data;
        this.table.listQuery.orderBy = prop;
        this.table.listQuery.ascending = order;
        this.getList();
      },
      remove(id) {
        this.$confirm(this.$t('messages.delete_confirm', { attribute: this.$t('table.data_excel.id') + '#' + id }), this.$t('messages.warning'), {
          confirmButtonText: this.$t('button.ok'),
          cancelButtonClass: this.$t('button.cancel'),
          type: 'warning',
          center: true,
        }).then(async () => {
          try {
            this.table.loading = true;
            await dataExcelResource.destroy(id);
            const index = this.table.list.findIndex(value => value.id === id);
            this.table.list.splice(index, 1);
            this.$message({
              showClose: true,
              message: this.$t('messages.delete'),
              type: 'success',
            });
            this.table.loading = false;
          } catch (e) {
            this.table.loading = false;
          }
        });
      },
    },
  };
</script>
