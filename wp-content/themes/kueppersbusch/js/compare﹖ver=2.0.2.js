(function($) {

    var Compare = {

        cookieName: '___compare',

        callbacks: [],

        exists: function(id) {
            var data = this.getCookie();

            for (var c in data) 
            {
                for (var i in data[c])
                {
                    if (i == id) 
                    {
                        return true;
                    }
                }
            }

            return false;
        },

        //Hay que pasarle un objeto con parametro ref con ID unica. Los otros valores son opcionales.
        add: function(values) {

            var data = this.getCookie();

            if (this.getTotalProducts(values.cat) < 4) {
                // console.log("Add category " + values.cat);
                // console.log("Add item ID " + values.id);

                if (data[values.cat] === undefined) {
                    data[values.cat] = {};
                }


                data[values.cat][values.id] = values;
            } else {
                console.log("límite de 4");
            }


            this.setCookie(data);
            this.raiseUpdate();
        },

        remove: function(id) {
            var data = this.getCookie();

            for (var c in data) 
            {
                for (var i in data[c])
                {
                    if (i == id) 
                    {
                        delete data[c][i];
                    }
                }
            }

            this.setCookie(data);
            this.raiseUpdate();
        },

        getTotalProducts: function(cat) {

            var data = this.getCookie();
            var total = 0;

            $count = 0;
            for (var i in data[cat]) {
                $count++;
                //total += data[i].qty;
            }

            return $count;
        },


        reset: function() {
            Cookies.remove(this.cookieName);
            this.raiseUpdate();
        },

        parseCompareParams: function(category) {
            var data = this.getCookie();
            var params = "";

            for (var c in data[category]) 
            {
                item = data[category][c];

                if (params.length) params += "&";
                params += "products[]=" + item.id;
            }

            return params;
        },

        parseTemplate: function(catId, template, addData, reverse) {

            reverse = reverse === undefined ? false : true;

            addData = addData === undefined ? {} : addData;

            var data = this.getCookie();
            var html = '';

            var cat, item, field, itemHTML;
            for (var i in data) 
            {
                cat = data[i];

                for (var c in cat) 
                {
                    item = cat[c];

                    if (item.cat == catId)
                    {
                        itemHTML = template;
                        for (var p in item) {
                            field = item[p];
                            itemHTML = itemHTML.split('{' + p + '}').join(item[p]);
                        }

                        //Reemplazamos los campos de data
                        if (addData[item.id]) {
                            var adddataItem = addData[item.id];
                            for (var p in adddataItem) {
                                itemHTML = itemHTML.split('{' + p + '}').join(adddataItem[p]);
                            }
                        }

                        if (reverse) {
                            html = itemHTML + html;
                        } else {
                            html += itemHTML;
                        }                        
                    } 
                }
            }

            return html;
        },

        //Core

        onUpdate: function(func) {
            this.callbacks.push(func);
        },

        raiseUpdate: function() {
            for (var i in this.callbacks) this.callbacks[i]();
        },

        getCookie: function() {
            var c = Cookies.get(this.cookieName);
            if (c === undefined) c = {};
            else c = JSON.parse(c);
            return c;
        },

        setCookie: function(data) {
            return Cookies.set(this.cookieName, data, { expires: 365 });
        }
    };

    window.Compare = Compare;

})(jQuery);
