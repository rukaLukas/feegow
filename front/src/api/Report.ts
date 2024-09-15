// @ts-ignore
import Api from './Api';
import * as dateHelpers from '@/helpers/date';

class Report extends Api {
  constructor(url:string) {    
    super(url);
  }

  async unvaccinatedEmployees(): Promise<any> {
      const data = await super.get('/unvaccinatedEmployees');    
      return data;
  }

  async checkStatus(): Promise<any> {
    const data = await super.get('/checkStatus');    
    return data;
  }
}

export default new Report('reports');
