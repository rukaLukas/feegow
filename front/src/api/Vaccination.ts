// @ts-ignore
import Api from './Api';
import * as dateHelpers from '@/helpers/date';

class Vaccination extends Api {
  constructor(url:string) {    
    super(url);
  }

  async getAll(filter?: {}): Promise<any> {
      const data = await super.getAll(filter);
      let vaccinations = data.data.data;
  
      vaccinations.forEach((value, key) => {
        value.first_dose_date = dateHelpers.FormatStringDatePTBR(value.first_dose_date)
        value.second_dose_date = dateHelpers.FormatStringDatePTBR(value.second_dose_date)
        value.third_dose_date = dateHelpers.FormatStringDatePTBR(value.third_dose_date)
      })

      return data;
  }
}

export default new Vaccination('vaccinations');
