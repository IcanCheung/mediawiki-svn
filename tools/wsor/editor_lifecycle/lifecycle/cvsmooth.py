import numpy as np
from scipy.interpolate import splrep, splev, UnivariateSpline
from scipy.optimize import fmin_tnc
import scipy.optimize.tnc as tnc

def spsmooth(x, y, ye, **kwargs):
    ''' 
    Finds the best spline smoothing factor using leave-one-out cross validation

    Additional keyword arguments are passed to splrep (e.g. k for the degree)
    '''

    best = []
    N = len(x)

    smax = 10
    ss = smax / 100.0
    slist = list(np.arange(ss, smax, ss))

    for i in xrange(N):

        train_idx = np.arange(N) != i
        test_idx = True - train_idx

        train_x = x[train_idx]
        train_y = y[train_idx]
        train_w = ye[train_idx] ** -1

        test_x = x[test_idx]
        test_y = y[test_idx]
        
        s_best = None
        err_best = np.inf
        
        for s in slist:
            tck = splrep(train_x, train_y, w=train_w, s=s, **kwargs)
            err = np.sqrt((splev(test_x, tck) - test_y) ** 2)
            
            if err < err_best:
                s_best = s
                err_best = err

        best.append(s_best)

    return np.mean(best)
        
def find_peak(x,y,ye,k=3):
    '''
    Finds maximum in time series (x_i, y_i) using smoothing splines

    Parameters
    ----------
    x,y - data
    ye  - standard errors estimates
    k   - spline degree (must be <= 5)
    '''
    s = spsmooth(x, y, ye, k=k)
    spl = UnivariateSpline(x, y, ye ** -1, k=k, s=s)
    f = lambda k : -spl(k)
    fprime = np.vectorize(lambda k : - spl.derivatives(k)[1])
    xp_best = None
    yp_best = -np.inf
    bounds = [(x.min(), x.max())]
    for i in xrange(5):
        x0 = (x.ptp() * np.random.rand() + x.min(),)
        xp, nfeval, rc = fmin_tnc(f, x0, fprime=fprime, bounds=bounds,
                messages=tnc.MSG_NONE)
        yp = spl(xp)
        if yp >= yp_best:
            xp_best = xp
            yp_best = yp
    return xp_best, spl