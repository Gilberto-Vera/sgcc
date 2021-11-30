<footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Sistema de Gerenciamento para Cerimonial de Casamento 2021</span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        
        <script src="vendor/jquery/jquery.min.js"></script>
        <!-- <script src="vendor/jquery-easing/jquery.easing.min.js"></script> -->
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/js/sb-admin-2.min.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function(){
                $("#modal_del").on('show.bs.modal',function(event){
                    let button  = $(event.relatedTarget);
                    let id = button.data('id');
                    $('#remove').attr("href", '?delete=' + id);
                });
            });
        </script>

        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="/js/demo/datatables-demo.js"></script>

    
    </body>
</html>