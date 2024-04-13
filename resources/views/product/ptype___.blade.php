<!-- Custom -->
@if($side['side_custom'])
                            @foreach($side['side_custom'] as $side_customs)
                                <div class="sidebar__categories">
                                    <div class="section-title"><h4>{{$side_customs['label']}}</h4></div>
                                    <div>
                                    @if($side_customs['col'])
                                        @foreach($side_customs['col'] as $side_customs_cols)
                                            <input type="checkbox" name="input_custom[]" id="input_custom" value="{{ $side_customs_cols['id']}}" /> &nbsp;{{ $side_customs_cols['value']}}<br/>
                                        @endforeach
                                    @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif