<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('laporan.index') }}" method="get" data-toggle="validator" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h4 class="modal-title"><i class="fa fa-calendar-alt mr-2"></i> Pilih Periode Laporan</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="tanggal_awal" class="col-lg-3 col-form-label font-weight-bold">Tanggal Awal</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" required
                                    autofocus value="{{ request('tanggal_awal') }}" placeholder="Pilih tanggal awal">
                            </div>
                            <small class="form-text text-muted">Masukkan tanggal awal laporan.</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_akhir" class="col-lg-3 col-form-label font-weight-bold">Tanggal
                            Akhir</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" required
                                    value="{{ request('tanggal_akhir') ?? date('Y-m-d') }}"
                                    placeholder="Pilih tanggal akhir">
                            </div>
                            <small class="form-text text-muted">Masukkan tanggal akhir laporan.</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                        <i class="fa fa-times-circle"></i> Batal
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>