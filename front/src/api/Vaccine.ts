// @ts-ignore
import Api from './Api';
import * as dateHelpers from '@/helpers/date';

class Vaccine extends Api {
  constructor(url:string) {    
    super(url);
  }

  async getAll(filter?: {}): Promise<any> {
      const data = await super.getAll(filter);
      let vaccines = data.data.data;
  
      vaccines.forEach((value, key) => {
        value.expiration_date = dateHelpers.FormatStringDatePTBR(value.expiration_date) //ndata;
      })

      return data;
  }
}

export default new Vaccine('vaccines');
