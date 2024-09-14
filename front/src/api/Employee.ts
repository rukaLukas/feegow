// @ts-ignore
import Api from './Api';
import * as dateHelpers from '@/helpers/date';

class Employee extends Api {
  constructor(url:string) {    
    super(url);
  }

  async getAll(filter?: {}): Promise<any> {
      const data = await super.getAll(filter);
      let employees = data.data.data;
  
      employees.forEach((value, key) => {
        let ndata = dateHelpers.FormatStringDatePTBR(value.date_of_birth)
        value.date_of_birth = ndata;
      })

      return data;
  }
}

export default new Employee('employees');
