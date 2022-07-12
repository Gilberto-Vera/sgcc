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
        <script src="/js/datepicker/bootstrap-datepicker.js"></script>
        <script src="/js/datepicker/bootstrap-datepicker.min.js"></script>
        <script src="/js/datepicker/bootstrap-datepicker.pt-BR.min.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function(){
                $("#modal_del").on('show.bs.modal',function(event){
                    let button  = $(event.relatedTarget);
                    let id = button.data('id');
                    $('#remove').attr("href", '?delete=' + id);
                });
            });
        </script>
        
        <script type="text/javascript">
            $(document).ready(function(){
                $("#modal_model_del").on('show.bs.modal',function(event){
                    let button  = $(event.relatedTarget);
                    let id = button.data('id');
                    let eventid = button.data('eventid');
                    $('#remove').attr("href", '?delete=' + id + '&event=' + eventid);
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function(){
                $("#modal_export_model").on('show.bs.modal',function(event){
                    let button  = $(event.relatedTarget);
                    let roadmapid = button.data('roadmapid');
                    $('#save').attr("href", 'export_import_roadmap_model.php?roadmap=' + roadmapid);
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function(){
                $("#modal_import_model").on('show.bs.modal',function(event){
                    let button  = $(event.relatedTarget);
                    let roadmapid = button.data('roadmapid');
                    let eventid = button.data('eventid');
                    $('#save').attr("href", 'export_import_roadmap_model.php?roadmap=' + roadmapid + '&event=' + eventid);
                });
            });
        </script>

        <script type="text/javascript">
            $('#date').datepicker({
                format: "dd-mm-yyyy",
                startDate: "today",
                language: "pt-BR"
            });
        </script>

        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="/js/demo/datatables-demo.js"></script>

    
    </body>
</html>