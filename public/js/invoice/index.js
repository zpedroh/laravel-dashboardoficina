var app = new Vue({
  el: '#invoiceDetails',
  data: function data() {
    return {
      items: [
        { description: 'David Hanaford Web Development', hours: 8, rate: 45 }]
    };


  },
  computed: {
    total: function total() {
      return this.items.reduce(function (acc, val) {
        return (
          acc + val.hours * val.rate);
      }, 0);

    }
  },

  methods: {
    addItem: function addItem() {
      this.items.push({
        description: null,
        hours: null,
        rate: 45
      });

    },
    formatCost: function formatCost(item) {
      var cost = item.hours * item.rate;
      return this.formatPrice(cost);
    },
    formatPrice: function formatPrice(value) {
      var val = value.toFixed(2);
      return val.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    },
    removeItem: function removeItem(index) {
      this.items.splice(index, 1);
    }
  }
});