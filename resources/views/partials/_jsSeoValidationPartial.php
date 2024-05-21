
<script type="text/javascript">

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('#addPageForm #seo_page_name').addEventListener('blur', function(e) {
            e.preventDefault();
            checkPageName(this);
        });

        /**
         * @param pageName
         */
        function checkPageName(pageName) {
            if (pageName.value == '') {
                document.getElementById('info').innerHTML = '';
                return;
            }

            params = "pageName=" + pageName.value;
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            request = new ajaxRequest();
            request.open("POST", "/testproj/public/seo/check-page-name", true);
            request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            request.setRequestHeader("X-CSRF-TOKEN", csrfToken);

            request.onreadystatechange = function () {
                if (this.readyState == 4) {
                    if (this.status == 200) {
                        if (this.responseText != null) {
                            document.getElementById('info').innerHTML =
                                this.responseText;
                        }
                        else alert("Ajax error: No data received");
                    }
                    else alert("Ajax error: " + this.statusText);
                }
            }
            request.send(params);
        }


        function ajaxRequest() {
            try {
                var request = new XMLHttpRequest()
            }
            catch (e1) {
                try {
                    request = new ActiveXObject("Msxml2.XMLHTTP")
                }
                catch (e2) {
                    try {
                        request = new ActiveXObject("Microsoft.XMLHTTP")
                    }
                    catch (e3) {
                        request = false
                    }
                }
            }
            return request
        }
    });

    function confirmDelete(event) { 
        event.preventDefault(); 

        if (confirm("Are you sure you want to delete this item?")) {
            document.getElementById("deleteForm").submit(); 
        }
    }
</script>