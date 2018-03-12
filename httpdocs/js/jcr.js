function mk_e_link(dom, subdom, usr, sub) {
    var lnk = subdom + '.' + dom;
    lnk = usr + '@' + lnk;
    var t_op = 'mai'
    t_op = '<' + 'a hr' + 'ef=' + t_op + 'lto:';
    t_op += lnk;
    if (sub != '')
        t_op += '?subj' + 'ect=' + escape(sub);
    document.write(t_op + '>');
    t_op = '<' + '/a>';
    document.write(lnk + t_op);
}
