@livewireScripts
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
    integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/js/all.min.js"
    integrity="sha512-gBYquPLlR76UWqCwD06/xwal4so02RjIR0oyG1TIhSGwmBTRrIkQbaPehPF8iwuY9jFikDHMGEelt0DtY7jtvQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- jQuery (required for DataTables) -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<!-- Chart library -->
<script src="{{ asset('assets/plugins/chart.min.js') }}"></script>
<!-- Icons library -->
<script src="{{ asset('assets/plugins/feather.min.js') }}"></script>
<!-- Custom scripts -->
<script src="{{ asset('assets/js/script.js') }}"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Initialize Select2 -->
<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Select an option",
        allowClear: true,
        width: '100%'
    });
});
</script>

{{-- get paper detail absentees --}}
<script>
$(document).ready(function() {
    $('#date, #session').on('change', function() {
        let exam_date = $('#date').val();
        let session = $('#session').val();

        if (exam_date && session) {
            $.ajax({
                url: '{{ route("get.paper.details") }}',
                type: 'GET',
                data: {
                    exam_date: exam_date,
                    session: session
                },
                success: function(response) {
                    console.log('AJAX Response:', response);
                    $('#subject_code').val(response.subject_code || '');
                    $('#paper_code').val(response.paper_code || '');
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    $('#subject_code').val('');
                    $('#paper_code').val('');
                }
            });
        } else {
            $('#subject_code').val('');
            $('#paper_code').val('');
        }
    });
});
</script>

{{--  <script>
    $(document).ready(function() {
        $('#center_no, #date, #session').on('change', function() {
            let center_no = $('#center_no').val();
            let exam_date = $('#date').val();
            let session = $('#session').val();

            if(center_no && exam_date && session) {
                $.ajax({
                    url: '{{ route("get.paper.details") }}',
                    type: 'GET',
                    data: {
                        center_no: center_no,
                        exam_date: exam_date,
                        session: session
                    },
                    success: function(response) {
                        console.log('AJAX Response:', response); // Debug
                        $('#subject_code').val(response.subject_code || '');
                        $('#paper_code').val(response.paper_code || '');
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                        $('#subject_code').val('');
                        $('#paper_code').val('');
                    }
                });
            } else {
                // Clear fields if inputs are incomplete
                $('#subject_code').val('');
                $('#paper_code').val('');
            }
        });
    });
</script>  --}}

{{-- get paper details medium --}}
<script>
$(document).ready(function() {

    // Auto-fill Subject & Paper Codes
    $('#center_no, #date, #session').on('change', function() {
        let center_no = $('#center_no').val();
        let exam_date = $('#date').val();
        let session = $('#session').val();

        if (center_no && exam_date && session) {
            $.ajax({
                url: '{{ route("get.paper_medium.details") }}',
                type: 'GET',
                data: {
                    center_no: center_no,
                    exam_date: exam_date,
                    session: session
                },
                success: function(response) {
                    $('#subject_code').val(response.subject_code || '');
                    $('#paper_code').val(response.paper_code || '');
                },
                error: function() {
                    $('#subject_code').val('');
                    $('#paper_code').val('');
                }
            });
        }
    });

    $(document).ready(function() {
    // Trigger when index_no changes
    $('#index_no').on('blur', function() {
        let center_no   = $('#center_no').val();
        let exam_date   = $('#date').val();
        let session     = $('#session').val();
        let subject_code = $('#subject_code').val();
        let paper_code   = $('#paper_code').val();
        let index_no     = $('#index_no').val();

        if(center_no && exam_date && session && subject_code && paper_code && index_no) {
            $.ajax({
                url: '{{ route("get.medium") }}',
                type: 'GET',
                data: {
                    center_no: center_no,
                    exam_date: exam_date,
                    session: session,
                    subject_code: subject_code,
                    paper_code: paper_code,
                    index_no: index_no
                },
                success: function(response) {
                    console.log('Medium Response:', response);
                    $('#medium_no').val(response.medium_no || '');
                },
                error: function() {
                    $('#medium_no').val('');
                }
            });
        } else {
            $('#medium_no').val('');
        }
    });
});

});
</script>


<script>
$('#date').datepicker({
    format: 'yyyy-mm-dd',    // Laravel-friendly format
    autoclose: true,
    todayHighlight: true
});
</script>



{{--  <script>
    $(document).ready(function() {
        $('#index_no').focus();

        $('#index_no').on('blur', function() {
            let indexNo = $(this).val();
            if (!indexNo) return;

            $.ajax({
                url: "{{ route('get.exam.data', '') }}/" + indexNo,
                type: "GET",
                success: function(result) {
                    if (result && result.subjects.length > 0) {
                        $('#index_error').addClass('d-none').text('');
                        $('#index_no').removeClass('is-invalid');

                        //get center no
                        $('#center_no').val(result.center_no || '');

                        //subject no
                        let subjectsHtml = '';
                        result.subjects.forEach(function(s) {
                            subjectsHtml +=
                                `<span class="badge bg-info m-1 subject-item" data-subject="${s.subject_no}">${s.subject_no}</span>`;
                        });

                        $('#subject_list').html(subjectsHtml);
                        $('#paper_list').html('');
                    } else {
                        $('#center_no').val('');
                        $('#subject_list').html('');
                        $('#paper_list').html('');

                        $('#index_error').removeClass('d-none').text("Invalid index number");
                        $('#index_no').addClass('is-invalid').focus().select();
                    }
                },
                error: function() {
                    $('#center_no').val('');
                    $('#subject_list').html('');
                    $('#paper_list').html('');

                     $('#index_error').removeClass('d-none').text("Invalid index number");
                        $('#index_no').addClass('is-invalid').focus().select();
                }
            });
        });

        //subject badge is clicked
        $(document).on('click', '.subject-item', function() {
            let subjectNo = $(this).data('subject');
            $('#subject_no').val(subjectNo).focus();
            loadPapers(subjectNo);
        });

        //subject typed and enter
        $('#subject_no').on('keydown', function(e) {
            if (e.key === "Enter") {
                e.preventDefault();
                let subjectNo = $(this).val();
                let indexNo = $('#index_no').val();
                if (!indexNo || !subjectNo) return;

                $.ajax({
                    url: "{{ route('get.exam.data', '') }}/" + indexNo,
                    type: "GET",
                    success: function(result) {
                        let subjectData = result.subjects.find(s => s.subject_no ==
                            subjectNo);
                        if (subjectData) {
                            $('#subject_error').addClass('d-none').text('');
                            $('#subject_no').removeClass('is-invalid');

                            loadPapers(subjectNo);
                            $('#paper_code').focus();
                        } else {
                            $('#paper_list').html('');
                            $('#subject_error').removeClass('d-none').text(
                                "Entered subject number is invalid");
                            $('#subject_no').addClass('is-invalid').focus().select();
                        }
                    }
                });
            }
        });

        //paper code type & enter
        $('#paper_code').on('keydown', function(e) {
            if (e.key === "Enter") {
                e.preventDefault();
                let paperCode = $(this).val();
                let subjectNo = $('#subject_no').val();
                let indexNo = $('#index_no').val();
                if (!indexNo || !subjectNo || !paperCode) return;

                $.ajax({
                    url: "{{ route('get.exam.data', '') }}/" + indexNo,
                    type: "GET",
                    success: function(result) {
                        let subjectData = result.subjects.find(s => s.subject_no ==
                            subjectNo);
                        if (subjectData) {
                            let validPaper = subjectData.papers.find(p => p == paperCode);
                            if (validPaper) {
                                $('#paper_error').addClass('d-none').text('');
                                $('#paper_code').removeClass('is-invalid');

                            } else {
                            $('#paper_error').removeClass('d-none').text(
                                "Entered paper code is invalid");
                            $('#paper_code').addClass('is-invalid').focus().select();
                        }
                    }
                    }
                });
            }
        });



        //paper badge is clicked
        $(document).on('click', '.paper-item', function() {
            $('#paper_code').val($(this).data('paper')).removeClass('is-invalid');
            $('#paper_error').addClass('d-none').text('');
            $('#paper_code').focus();
        });

        //function load paper codes
        function loadPapers(subjectNo) {
            let indexNo = $('#index_no').val();
            if (!indexNo) return;

            $.ajax({
                url: "{{ route('get.exam.data', '') }}/" + indexNo,
                type: "GET",
                success: function(result) {
                    let subjectData = result.subjects.find(s => s.subject_no == subjectNo);
                    if (subjectData) {
                        let papersHtml = '';
                        subjectData.papers.forEach(function(p) {
                            papersHtml +=
                                `<span class="badge bg-secondary m-1 paper-item" data-paper="${p}">${p}</span>`;

                        });
                        $('#paper_list').html(papersHtml);
                    } else {
                        $('paper_list').html('');
                    }
                }
            });
        }

        //move to next input with enter
        $('form').on('keydown', 'input', function(e) {
            if (e.key === "Enter") {
                e.preventDefault();

                let inputs = $('form').find(':input:visible:not([disables])');
                let idx = inputs.index(this);

                if (idx === inputs.length - 1) {
                    $('form').submit();
                } else {
                    inputs.eq(idx + 1).focus();
                }
            }
        });

    });
</script>  --}}

<script>
    $(document).ready(function() {
        $('#examTable').DataTable({
            language: {
                emptyTable: "No data available in the table",
                paginate: {
                    previous: '<i class="fa-solid fa-angles-left"></i>',
                    next: '<i class="fa-solid fa-angles-right"></i>'
                }
            },
            pageLength: 10,
            lengthMenu: [5, 10, 20],
            order: [
                [0, "desc"]
            ] // Sort by Subject No column
        });
    });
</script>

{{--  <script>
$(document).ready(function () {
    $('#examTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        responsive: true
    });
});
</script>  --}}

{{--  <script>
$(document).ready(function () {

    $('#index_no').focus();
    // Handle Index No blur
    $('#index_no').on('blur', function () {
        let indexNo = $(this).val();
        if (!indexNo) return;

        $.ajax({
            url: "{{ route('get.exam.data', '') }}/" + indexNo,
            type: "GET",
            success: function (res) {
                if (res && res.subjects.length > 0) {
                    // Fill center no
                    $('#center_no').val(res.center_no || '');

                    // Show subject list
                    let subjectsHtml = '';
                    res.subjects.forEach(function (s) {
                        subjectsHtml += `<span class="badge bg-info m-1 subject-item" data-subject="${s.subject_no}">${s.subject_no}</span>`;
                    });
                    $('#subject_list').html(subjectsHtml);

                    // Clear old paper list
                    $('#paper_list').html('');
                } else {
                    $('#center_no').val('');
                    $('#subject_list').html('');
                    $('#paper_list').html('');
                }
            },
            error: function () {
                $('#center_no').val('');
                $('#subject_list').html('');
                $('#paper_list').html('');
            }
        });
    });

    // When subject badge is clicked
    $(document).on('click', '.subject-item', function () {
        let subjectNo = $(this).data('subject');
        $('#subject_no').val(subjectNo).focus();
        loadPapers(subjectNo);
    });

    // When subject is typed + Enter pressed
    $('#subject_no').on('keydown', function (e) {
        if (e.key === "Enter") {
            e.preventDefault();
            let subjectNo = $(this).val();
            if (subjectNo) {
                loadPapers(subjectNo);
                $('#paper_code').focus();
            }
        }
    });

    // When paper badge is clicked
    $(document).on('click', '.paper-item', function () {
        $('#paper_code').val($(this).data('paper')).focus();
    });

    // Common function to load papers
    function loadPapers(subjectNo) {
        let indexNo = $('#index_no').val();
        if (!indexNo) return;

        $.ajax({
            url: "{{ route('get.exam.data', '') }}/" + indexNo,
            type: "GET",
            success: function (res) {
                let subjectData = res.subjects.find(s => s.subject_no == subjectNo);
                if (subjectData) {
                    let papersHtml = '';
                    subjectData.papers.forEach(function (p) {
                        papersHtml += `<span class="badge bg-secondary m-1 paper-item" data-paper="${p}">${p}</span>`;
                    });
                    $('#paper_list').html(papersHtml);
                } else {
                    $('#paper_list').html('');
                }
            }
        });
    }

    // Move to next input on Enter
    $('form').on('keydown', 'input', function (e) {
        if (e.key === "Enter") {
            e.preventDefault();

            let inputs = $('form').find(':input:visible:not([disabled])');
            let idx = inputs.index(this);

            if (idx === inputs.length - 1) {
                // Last input → submit form
                $('form').submit();
            } else {
                // Move to next input
                inputs.eq(idx + 1).focus();
            }
        }
    });

});
</script>  --}}

{{--  <script>
$(document).ready(function () {
    // Handle Index No blur
    $('#index_no').on('blur', function () {
        let indexNo = $(this).val();
        if (!indexNo) return;

        $.ajax({
            url: "{{ route('get.exam.data', '') }}/" + indexNo,
            type: "GET",
            success: function (res) {
                if (res && res.subjects.length > 0) {
                    // Fill center no
                    $('#center_no').val(res.center_no || '');

                    // Show subject list
                    let subjectsHtml = '';
                    res.subjects.forEach(function (s) {
                        subjectsHtml += `<span class="badge bg-info m-1 subject-item" data-subject="${s.subject_no}">${s.subject_no}</span>`;
                    });
                    $('#subject_list').html(subjectsHtml);

                    // Clear old paper list
                    $('#paper_list').html('');
                } else {
                    $('#center_no').val('');
                    $('#subject_list').html('');
                    $('#paper_list').html('');
                }
            },
            error: function () {
                $('#center_no').val('');
                $('#subject_list').html('');
                $('#paper_list').html('');
            }
        });
    });

    // When subject is selected
    $(document).on('click', '.subject-item', function () {
        let subjectNo = $(this).data('subject');
        $('#subject_no').val(subjectNo).focus();

        let indexNo = $('#index_no').val();
        if (!indexNo) return;

        $.ajax({
            url: "{{ route('get.exam.data', '') }}/" + indexNo,
            type: "GET",
            success: function (res) {
                let subjectData = res.subjects.find(s => s.subject_no == subjectNo);
                if (subjectData) {
                    let papersHtml = '';
                    subjectData.papers.forEach(function (p) {
                        papersHtml += `<span class="badge bg-secondary m-1 paper-item" data-paper="${p}">${p}</span>`;
                    });
                    $('#paper_list').html(papersHtml);
                }
            }
        });
    });

    // When paper is selected
    $(document).on('click', '.paper-item', function () {
        $('#paper_code').val($(this).data('paper')).focus();
    });

    // Move to next input on Enter key
    $('form').on('keydown', 'input', function (e) {
        if (e.key === "Enter") {
            e.preventDefault();

            let inputs = $('form').find(':input:visible:not([disabled],[readonly])');
            let idx = inputs.index(this);

            if (idx === inputs.length - 1) {
                // Last input -> submit form
                $('form').submit();
            } else {
                // Move to next input
                inputs.eq(idx + 1).focus();
            }
        }
    });
});
</script>  --}}


{{--  <script>
$(document).ready(function () {
    // Handle Index No blur
    $('#index_no').on('blur', function () {
        let indexNo = $(this).val();
        if (!indexNo) return;

        $.ajax({
            url: "{{ route('get.exam.data', '') }}/" + indexNo,
            type: "GET",
            success: function (res) {
                if (res && res.subjects.length > 0) {
                    // Fill center no
                    $('#center_no').val(res.center_no || '');

                    // Show subject list
                    let subjectsHtml = '';
                    res.subjects.forEach(function (s) {
                        subjectsHtml += `<span class="badge bg-info m-1 subject-item" data-subject="${s.subject_no}">${s.subject_no}</span>`;
                    });
                    $('#subject_list').html(subjectsHtml);

                    // Clear old paper list
                    $('#paper_list').html('');
                } else {
                    $('#center_no').val('');
                    $('#subject_list').html('');
                    $('#paper_list').html('');
                }
            },
            error: function () {
                $('#center_no').val('');
                $('#subject_list').html('');
                $('#paper_list').html('');
            }
        });
    });

    // When subject is selected
    $(document).on('click', '.subject-item', function () {
        let subjectNo = $(this).data('subject');
        $('#subject_no').val(subjectNo);

        let indexNo = $('#index_no').val();
        if (!indexNo) return;

        $.ajax({
            url: "{{ route('get.exam.data', '') }}/" + indexNo,
            type: "GET",
            success: function (res) {
                let subjectData = res.subjects.find(s => s.subject_no == subjectNo);
                if (subjectData) {
                    let papersHtml = '';
                    subjectData.papers.forEach(function (p) {
                        papersHtml += `<span class="badge bg-secondary m-1 paper-item" data-paper="${p}">${p}</span>`;
                    });
                    $('#paper_list').html(papersHtml);
                }
            }
        });
    });

    // When paper is selected
    $(document).on('click', '.paper-item', function () {
        $('#paper_code').val($(this).data('paper'));
    });

    // Submit with Enter key
    $('input').keypress(function (e) {
        if (e.which === 13) {
            e.preventDefault();
            $('form').submit();
        }
    });
});
</script>  --}}

{{--  <script>
$(document).ready(function () {
    $('#index_no').on('blur', function () {
        let indexNo = $(this).val();

        if (indexNo) {
            $.ajax({
                url: "{{ route('get.exam.data', '') }}/" + indexNo,
                type: "GET",
                success: function (data) {
                    if (data.length > 0) {
                        // Fill center no
                        $('#center_no').val(data[0].center_no || '');

                        // Build subject + paper lists
                        let subjectsHtml = '';
                        let papersHtml = '';
                        data.forEach(function (item) {
                            subjectsHtml += `<span class="badge bg-info m-1">${item.subject_no}</span>`;
                            papersHtml   += `<span class="badge bg-secondary m-1">${item.paper_code}</span>`;
                        });

                        $('#subject_list').html(subjectsHtml);
                        $('#paper_list').html(papersHtml);
                    } else {
                        $('#center_no').val('');
                        $('#subject_list').html('');
                        $('#paper_list').html('');
                    }
                },
                error: function () {
                    $('#center_no').val('');
                    $('#subject_list').html('');
                    $('#paper_list').html('');
                }
            });
        } else {
            $('#center_no').val('');
            $('#subject_list').html('');
            $('#paper_list').html('');
        }
    });
});
</script>  --}}

{{--  <script>
    $(document).ready(function() {
        $('#index_no').on('blur', function() {
            let indexNo = $(this).val();

            if (indexNo) {
                $.ajax({
                    url: "{{ route('get.exam.data', '') }}/" + indexNo,
                    type: "GET",
                    success: function(data) {
                        $('#center_no').val(data.center_no || '');
                        $('#subject_no').val(data.subject_no || '');
                        $('#paper_code').val(data.paper_code || '');
                    },
                    error: function() {
                        $('#center_no').val('');
                        $('#subject_no').val('');
                        $('#paper_code').val('');
                    }
                });
            } else {
                $('#center_no').val('');
                $('#subject_no').val('');
                $('#paper_code').val('');
            }
        });
    });
</script>  --}}
{{--  <script>
    $(document).ready(function () {
        $('#index_no').on('blur', function () {
            let indexNo = $(this).val();

            if (indexNo) {
                $.ajax({
                    url: "{{ route('get.center.no', '') }}/" + indexNo,
                    type: "GET",
                    success: function (data) {
                        $('#center_no').val(data.center_no || '');
                    },
                    error: function () {
                        $('#center_no').val('');
                        console.error("Could not fetch center_no. Check the route.");
                    }
                });
            } else {
                $('#center_no').val('');
            }
        });
    });
</script>  --}}
