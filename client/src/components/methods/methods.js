import moment from 'moment';
export default{
    methods:{
        getDaysInMonthArray(year, month){
            let day_arr = [];
            let maxDays = moment(year + '-' + month, 'YYYY-MM').daysInMonth();

            for (let i = 1; i <= maxDays; i++) {
                (i < 10) ? day_arr.push('0'+i) : day_arr.push(i.toString());
            }
            return day_arr;
        },

    }
};
